<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent' => 0,
                'name' => 'دسته بندی اول',
                'slug' => 'دسته-بندی-اول',
                'image' => '01J83RS9CM1HGF6C6E5BMSSV1K.png',
                'created_at' => '2024-09-18 23:40:55',
                'updated_at' => '2024-09-18 23:51:50',
            ),
        ));
        
        
    }
}