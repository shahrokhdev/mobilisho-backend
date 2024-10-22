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
                'id' => 3,
                'code' => 'jsxwww',
                'state' => 'unexpire',
                'discount_type' => 'percentage',
                'discount_value' => '40',
                'start_date' => '2024-10-15',
                'end_date' => '2024-10-18',
                'usage_limit' => 1,
                'created_at' => '2024-10-15 08:19:58',
                'updated_at' => '2024-10-15 14:00:45',
            ),
            1 => 
            array (
                'id' => 4,
                'code' => 'gwrhwrh',
                'state' => 'expired',
                'discount_type' => 'percentage',
                'discount_value' => '5',
                'start_date' => '2024-10-16',
                'end_date' => '2024-10-15',
                'usage_limit' => 1,
                'created_at' => '2024-10-16 17:14:50',
                'updated_at' => '2024-10-16 22:50:23',
            ),
            2 => 
            array (
                'id' => 23,
                'code' => 'test',
                'state' => 'unexpire',
                'discount_type' => 'percentage',
                'discount_value' => '70',
                'start_date' => '2024-10-17',
                'end_date' => '2024-10-20',
                'usage_limit' => 1,
                'created_at' => '2024-10-16 23:17:05',
                'updated_at' => '2024-10-16 23:17:05',
            ),
        ));
        
        
    }
}