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
                'id' => 2,
                'parent_id' => 4,
                'name' => 'موبایل',
                'slug' => 'موبایل',
                'image' => '01J8JGAE6959PXZAKNYB7C4QQT.jpg',
                'created_at' => '2024-09-24 17:12:32',
                'updated_at' => '2024-09-26 19:47:04',
            ),
            1 => 
            array (
                'id' => 3,
                'parent_id' => 2,
                'name' => 'لوازم جانبی',
                'slug' => 'لوازم-جانبی',
                'image' => '01J8JGBC7SAEWH9NA3VD41FTHZ.jpg',
                'created_at' => '2024-09-24 17:13:02',
                'updated_at' => '2024-09-26 19:49:40',
            ),
            2 => 
            array (
                'id' => 4,
                'parent_id' => 0,
                'name' => 'لوازم الکتریکی',
                'slug' => 'لوازم-الکتریکی',
                'image' => '01J8JYN12R1PTM3D4AZG4X1AKN.jpg',
                'created_at' => '2024-09-24 21:22:59',
                'updated_at' => '2024-09-24 21:22:59',
            ),
            3 => 
            array (
                'id' => 15,
                'parent_id' => 4,
                'name' => 'کنسول بازی',
                'slug' => 'کنسول-بازی',
                'image' => '01J8NWA7E8KR0C5B46HHTPK5GT.jpg',
                'created_at' => '2024-09-26 00:39:51',
                'updated_at' => '2024-09-26 00:39:51',
            ),
            4 => 
            array (
                'id' => 16,
                'parent_id' => 2,
                'name' => 'شیامی',
                'slug' => 'شیامی',
                'image' => '01J8NWCJZJDECMYVHPSWTEEHAQ.jpg',
                'created_at' => '2024-09-26 00:41:08',
                'updated_at' => '2024-09-26 19:47:32',
            ),
            5 => 
            array (
                'id' => 17,
                'parent_id' => 2,
                'name' => 'سامسونگ',
                'slug' => 'سامسونگ',
                'image' => '01J8NWEY5CZPQ65SVHDRPMJEJJ.jpg',
                'created_at' => '2024-09-26 00:42:25',
                'updated_at' => '2024-09-26 19:48:53',
            ),
            6 => 
            array (
                'id' => 18,
                'parent_id' => 0,
                'name' => 'لباس و پوشاک',
                'slug' => 'لباس-و-پوشاک',
                'image' => '01J8NWGRDG49349WXEDP5CYTJB.jpg',
                'created_at' => '2024-09-26 00:43:25',
                'updated_at' => '2024-09-26 00:43:25',
            ),
            7 => 
            array (
                'id' => 19,
                'parent_id' => 18,
                'name' => 'شلوار مردانه',
                'slug' => 'شلوار-مردانه',
                'image' => '01J8NWHFVS3MJVNSQNA5P17W75.jpg',
                'created_at' => '2024-09-26 00:43:49',
                'updated_at' => '2024-09-26 00:43:49',
            ),
            8 => 
            array (
                'id' => 20,
                'parent_id' => 18,
                'name' => 'لباس کودک',
                'slug' => 'لباس-کودک',
                'image' => '01J8NXN040PD437DGX1729TNNC.jpg',
                'created_at' => '2024-09-26 01:03:13',
                'updated_at' => '2024-09-26 01:03:13',
            ),
            9 => 
            array (
                'id' => 22,
                'parent_id' => 2,
                'name' => 'apple',
                'slug' => 'apple',
                'image' => '01J8QXV4VT96C26EW0SCSF5PM8.jpg',
                'created_at' => '2024-09-26 19:45:03',
                'updated_at' => '2024-09-26 19:45:03',
            ),
        ));
        
        
    }
}