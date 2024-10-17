<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('orders')->delete();
        
        \DB::table('orders')->insert(array (
            0 => 
            array (
                'id' => 2,
                'customer_id' => 2,
                'discount_id' => 0,
                'order_date' => '2024-10-12 00:00:00',
                'status' => 'pending',
                'total_amount' => '245242.00',
                'payment_method' => 'cash-on-delivery',
                'delivery_address' => 'whwerh',
                'final_price' => '1441.00',
                'star' => 2,
                'created_at' => '2024-10-12 20:05:56',
                'updated_at' => '2024-10-12 20:05:56',
            ),
        ));
        
        
    }
}