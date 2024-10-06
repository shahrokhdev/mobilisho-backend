<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'محصول آزماشی',
                'slug' => 'محصول-آزماشی',
                'description' => 'این محصول ازمایشی است',
                'image' => '01J8JG6WYEND9CQY1WHY1C5GRE.jpg',
                'price' => '5699999',
                'inventory' => 10,
                'view_count' => 0,
                'created_at' => '2024-09-24 17:10:36',
                'updated_at' => '2024-09-24 17:10:36',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'موبایل سامسونگ note 10',
                'slug' => 'موبایل-سامسونگ-note-10',
                'description' => 'موبایل سامسونگ note 10 اصل در سه رنگ',
                'image' => '01J8JGMRWCH4Y0SK1PPT9TVHVC.jpg',
                'price' => '20000000',
                'inventory' => 10,
                'view_count' => 0,
                'created_at' => '2024-09-24 17:18:10',
                'updated_at' => '2024-09-24 17:18:10',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'گوشی سامسونگ مدل ultra',
                'slug' => 'گوشی-سامسونگ-مدل-ultra',
                'description' => ' گوشی سامسونگ مدل ultra
با کیفیت بسیار عالی و اصل',
                'image' => '01J8TQRREAR5ZT4MN3VC1TDNYB.jpg',
                'price' => '35000000',
                'inventory' => 10,
                'view_count' => 0,
                'created_at' => '2024-09-27 21:56:36',
                'updated_at' => '2024-09-27 21:56:36',
            ),
            3 => 
            array (
                'id' => 20,
                'title' => 'mmmm',
                'slug' => 'mmmm',
                'description' => 'rhwrhwrhwerh',
                'image' => '01J9ENJF8NDB9PTDNB30Q92635.jpg',
                'price' => '35356236',
                'inventory' => 10,
                'view_count' => 0,
                'created_at' => '2024-10-05 15:43:02',
                'updated_at' => '2024-10-05 15:43:02',
            ),
            4 => 
            array (
                'id' => 21,
                'title' => 'teqgqegqeg',
                'slug' => 'teqgqegqeg',
                'description' => '34qegqewgqwerhwh',
                'image' => '01J9ENMM4WWCWSMTX8CAKHCVGF.jpg',
                'price' => '25252525',
                'inventory' => 3,
                'view_count' => 0,
                'created_at' => '2024-10-05 15:44:12',
                'updated_at' => '2024-10-05 15:44:12',
            ),
            5 => 
            array (
                'id' => 23,
                'title' => 'yyyyyyyyyyyyy',
                'slug' => 'yyyyyyyyyyyyy',
                'description' => 'gqeghqeheh',
                'image' => '01J9ENV1KWAZH9NKZ8PVA7BTGW.jpg',
                'price' => '3636363',
                'inventory' => 5,
                'view_count' => 0,
                'created_at' => '2024-10-05 15:47:43',
                'updated_at' => '2024-10-05 15:47:43',
            ),
            6 => 
            array (
                'id' => 24,
                'title' => 'ryywrywry',
                'slug' => 'ryywrywry',
                'description' => 'tejetjetj',
                'image' => '01J9ENWHXJ4HAGHP5FSQ80P0EP.jpg',
                'price' => '5636363',
                'inventory' => 7,
                'view_count' => 0,
                'created_at' => '2024-10-05 15:48:32',
                'updated_at' => '2024-10-05 15:48:32',
            ),
        ));
        
        
    }
}