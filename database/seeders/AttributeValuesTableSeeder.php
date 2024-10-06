<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AttributeValuesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attribute_values')->delete();
        
        \DB::table('attribute_values')->insert(array (
            0 => 
            array (
                'id' => 1,
                'attribute_id' => 1,
                'value' => 'قرمز',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'attribute_id' => 1,
                'value' => 'زرد',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'attribute_id' => 2,
                'value' => 'پلاستیک',
                'created_at' => '2024-10-02 19:38:57',
                'updated_at' => '2024-10-02 19:38:57',
            ),
            3 => 
            array (
                'id' => 4,
                'attribute_id' => 3,
                'value' => 'touch',
                'created_at' => '2024-10-03 09:41:59',
                'updated_at' => '2024-10-03 09:41:59',
            ),
            4 => 
            array (
                'id' => 5,
                'attribute_id' => 3,
                'value' => 'led',
                'created_at' => '2024-10-03 09:44:49',
                'updated_at' => '2024-10-03 09:44:49',
            ),
            5 => 
            array (
                'id' => 6,
                'attribute_id' => 3,
                'value' => 'test',
                'created_at' => '2024-10-03 14:52:29',
                'updated_at' => '2024-10-03 14:52:29',
            ),
        ));
        
        
    }
}