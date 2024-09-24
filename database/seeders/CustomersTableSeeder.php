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
                'id' => 1,
                'province_id' => 0,
                'city_id' => 0,
                'town_id' => 0,
                'name' => 'احمد',
                'family' => 'احمدی',
                'image' => '01J8HKSJ8B4Q40HKAXMSM1612A.png',
                'mobile' => '09366034345',
                'birth_date' => '2011-10-13',
                'gender' => 'male',
                'created_at' => '2024-09-24 08:53:59',
                'updated_at' => '2024-09-24 08:53:59',
            ),
        ));
        
        
    }
}