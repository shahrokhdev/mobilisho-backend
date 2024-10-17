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
                'id' => 4,
                'title' => 'wetwqetqwt',
                'slug' => 'wetwqetqwt',
                'description' => 'qwetqet',
                'image' => '01JA0P7GA1AD3AZJKBV99CC780.jpg',
                'price' => '1314',
                'inventory' => 1,
                'view_count' => 0,
                'created_at' => '2024-10-12 15:40:51',
                'updated_at' => '2024-10-12 15:40:51',
            ),
        ));
        
        
    }
}