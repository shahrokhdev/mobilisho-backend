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
    
    }
}