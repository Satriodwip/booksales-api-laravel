<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use App\Models\Book;

class TransactionController extends Controller
{
    /**
     * Admin only - Display all transactions
     */
    public function index()
    {
        $user = auth('api')->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access. Only admin can view all transactions.'
            ], 403);
        }

        $transactions = Transaction::with(['user', 'book'])->get();

        if ($transactions->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No transactions found.'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'Transactions retrieved successfully.',
            'data' => $transactions
        ], 200);
    }

    /**
     * Customer - Create a transaction
     */
    public function store(Request $request)
    {
        $user = auth('api')->user();

        if ($user->role !== 'customer') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only customers can create transactions.'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $book = Book::find($request->book_id);
        if ($book->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stock not sufficient.'
            ], 400);
        }

        $uniqueCode = 'ORD-' . strtoupper(uniqid());
        $totalAmount = $book->price * $request->quantity;

        // Update stock
        $book->stock -= $request->quantity;
        $book->save();

        // Create transaction
        $transaction = Transaction::create([
            'order_number' => $uniqueCode,
            'customer_id' => $user->id,
            'book_id' => $book->id,
            'total_amount' => $totalAmount,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully.',
            'data' => $transaction
        ], 201);
    }

    /**
     * Customer - Show own transaction
     */
    public function show(string $id)
    {
        $user = auth('api')->user();
        $transaction = Transaction::with(['book', 'user'])->find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found.'
            ], 404);
        }

        // Only owner (customer) or admin can view it
        if ($user->role !== 'admin' && $transaction->customer_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access to this transaction.'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => 'Transaction retrieved successfully.',
            'data' => $transaction
        ], 200);
    }

    /**
     * Customer - Update own transaction (only before processed)
     */
    public function update(Request $request, string $id)
    {
        $user = auth('api')->user();
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found.'
            ], 404);
        }

        // Customer hanya bisa update transaksi miliknya
        if ($user->role === 'customer' && $transaction->customer_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to update this transaction.'
            ], 403);
        }

        // Validasi
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $book = Book::find($transaction->book_id);
        $difference = $request->quantity - ($transaction->quantity ?? 1);

        // Jika quantity naik, pastikan stok cukup
        if ($difference > 0 && $book->stock < $difference) {
            return response()->json([
                'success' => false,
                'message' => 'Stock not sufficient for update.'
            ], 400);
        }

        // Update stok & total
        $book->stock -= $difference;
        $book->save();

        $transaction->update([
            'quantity' => $request->quantity,
            'total_amount' => $book->price * $request->quantity,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaction updated successfully.',
            'data' => $transaction
        ], 200);
    }

    /**
     * Admin only - Delete any transaction
     */
    public function destroy(string $id)
    {
        $user = auth('api')->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only admin can delete transactions.'
            ], 403);
        }

        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found.'
            ], 404);
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted successfully.'
        ], 200);
    }
}
