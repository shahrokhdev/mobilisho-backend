<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CopenCustomerTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('copen_customer')->delete();
        
        \DB::table('copen_customer')->insert(array (
            0 => 
            array (
                'id' => 3,
                'copen_id' => 3,
                'customer_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 4,
                'copen_id' => 3,
                'customer_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 5,
                'copen_id' => 4,
                'customer_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 6,
                'copen_id' => 4,
                'customer_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 27,
                'copen_id' => 23,
                'customer_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 28,
                'copen_id' => 23,
                'customer_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}