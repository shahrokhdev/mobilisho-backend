<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CopensTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('copens')->delete();
        
        \DB::table('copens')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'hwrhwrh',
                'state' => 'expired',
                'discount_type' => 'percentage',
                'discount_value' => '10',
                'start_date' => '2024-10-08',
                'end_date' => '2024-10-23',
                'usage_limit' => 1,
                'created_at' => NULL,
                'updated_at' => '2024-10-15 07:40:46',
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'teyrwehw',
                'state' => 'expired',
                'discount_type' => 'percentage',
                'discount_value' => '10',
                'start_date' => '2024-10-15',
                'end_date' => '2024-10-21',
                'usage_limit' => 1,
                'created_at' => '2024-10-15 07:42:23',
                'updated_at' => '2024-10-15 08:21:32',
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'jsxwww',
                'state' => 'expired',
                'discount_type' => 'percentage',
                'discount_value' => '40',
                'start_date' => '2024-10-15',
                'end_date' => '2024-10-17',
                'usage_limit' => 1,
                'created_at' => '2024-10-15 08:19:58',
                'updated_at' => '2024-10-15 08:21:32',
            ),
        ));
        
        
    }
}