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
        ));
        
        
    }
}