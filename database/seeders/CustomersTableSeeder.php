<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers')->delete();
        
        \DB::table('customers')->insert(array (
            0 => 
            array (
                'id' => 2,
                'user_id' => 2,
                'province_id' => 0,
                'city_id' => 0,
                'town_id' => 0,
                'name' => 'شاهرخ',
                'family' => 'قربانی نژاد',
                'image' => '01JA3KVEZN5JZ0P6AEF79CR6W5.jpg',
                'mobile' => '09366034345',
                'birth_date' => '2011-10-20',
                'gender' => 'male',
                'created_at' => '2024-10-13 18:57:02',
                'updated_at' => '2024-10-13 18:57:02',
            ),
            1 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'province_id' => 0,
                'city_id' => 0,
                'town_id' => 0,
                'name' => 'admin',
                'family' => 'admin',
                'image' => '01JA7J0HN1MAZPCAAE7ZMVWCRK.jpg',
                'mobile' => '09903478085',
                'birth_date' => '2024-10-15',
                'gender' => 'male',
                'created_at' => '2024-10-15 07:41:50',
                'updated_at' => '2024-10-15 07:41:50',
            ),
        ));
        
        
    }
}