<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderProductTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_product')->delete();
        
        \DB::table('order_product')->insert(array (
            0 => 
            array (
                'id' => 124,
                'product_id' => 2,
                'order_id' => 113,
                'quantity' => 3,
                'price' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 132,
                'product_id' => 1,
                'order_id' => 119,
                'quantity' => 2,
                'price' => '11399998',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 133,
                'product_id' => 2,
                'order_id' => 119,
                'quantity' => 2,
                'price' => '40000000',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 134,
                'product_id' => 3,
                'order_id' => 119,
                'quantity' => 2,
                'price' => '70000000',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}