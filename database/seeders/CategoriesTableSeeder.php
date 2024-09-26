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
                'parent_id' => 4,
                'name' => 'دسته بندی اول',
                'slug' => 'دسته-بندی-اول',
                'image' => '01J83RS9CM1HGF6C6E5BMSSV1K.png',
                'created_at' => '2024-09-18 23:40:55',
                'updated_at' => '2024-09-24 21:30:59',
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 4,
                'name' => 'موبایل',
                'slug' => 'موبایل',
                'image' => '01J8JGAE6959PXZAKNYB7C4QQT.jpg',
                'created_at' => '2024-09-24 17:12:32',
                'updated_at' => '2024-09-24 21:30:10',
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 4,
                'name' => 'لوازم جانبی',
                'slug' => 'لوازم-جانبی',
                'image' => '01J8JGBC7SAEWH9NA3VD41FTHZ.jpg',
                'created_at' => '2024-09-24 17:13:02',
                'updated_at' => '2024-09-24 21:31:22',
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 0,
                'name' => 'لوازم الکتریکی',
                'slug' => 'لوازم-الکتریکی',
                'image' => '01J8JYN12R1PTM3D4AZG4X1AKN.jpg',
                'created_at' => '2024-09-24 21:22:59',
                'updated_at' => '2024-09-24 21:22:59',
            ),
        ));
        
        
    }
}