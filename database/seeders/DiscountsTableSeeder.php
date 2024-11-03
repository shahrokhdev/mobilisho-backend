<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DiscountsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('discounts')->delete();
        
        \DB::table('discounts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'discount_type' => 'percent',
                'discount_value' => '15',
                'start_date' => '2024-10-30',
                'end_date' => '2024-11-01',
                'created_at' => '2024-10-30 14:01:55',
                'updated_at' => '2024-10-30 14:01:55',
            ),
            1 => 
            array (
                'id' => 2,
                'discount_type' => 'percent',
                'discount_value' => '40',
                'start_date' => '2024-11-13',
                'end_date' => '2024-11-13',
                'created_at' => '2024-10-30 14:03:19',
                'updated_at' => '2024-10-30 14:03:19',
            ),
        ));
        
        
    }
}