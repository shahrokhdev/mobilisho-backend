<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AttributeProductTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attribute_product')->delete();
        
        \DB::table('attribute_product')->insert(array (
            0 => 
            array (
                'attribute_id' => 1,
                'value_id' => 1,
                'product_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'attribute_id' => 1,
                'value_id' => 2,
                'product_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'attribute_id' => 1,
                'value_id' => 1,
                'product_id' => 21,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'attribute_id' => 1,
                'value_id' => 1,
                'product_id' => 23,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'attribute_id' => 1,
                'value_id' => 2,
                'product_id' => 23,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}