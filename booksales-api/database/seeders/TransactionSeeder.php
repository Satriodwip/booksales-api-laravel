<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        Transaction::create([
            'order_number' => 'ORD-001',
            'customer_id'  => 2, 
            'book_id'      => 1, 
            'total_amount' => 250000,
        ]);

        Transaction::create([
            'order_number' => 'ORD-002',
            'customer_id'  => 2,
            'book_id'      => 2,
            'total_amount' => 150000,
        ]);
    }
}
