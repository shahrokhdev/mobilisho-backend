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
                'product_id' => 2,
                'value_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (

                'attribute_id' => 1,
                'product_id' => 2,
                'value_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}