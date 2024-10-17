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
                'product_id' => 4,
                'attribute_id' => 1,
                'value_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'product_id' => 4,
                'attribute_id' => 1,
                'value_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'product_id' => 4,
                'attribute_id' => 3,
                'value_id' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'product_id' => 3,
                'attribute_id' => 2,
                'value_id' => 10,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'product_id' => 3,
                'attribute_id' => 3,
                'value_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'product_id' => 3,
                'attribute_id' => 1,
                'value_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}