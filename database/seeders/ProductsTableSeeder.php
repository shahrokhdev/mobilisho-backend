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
                'discount_id' => 1,
                'title' => 'محصول آزماشی',
                'slug' => 'محصول-آزماشی',
                'description' => 'این محصول ازمایشی است',
                'image' => '01J8JG6WYEND9CQY1WHY1C5GRE.jpg',
                'price' => '5699999',
                'inventory' => 10,
                'view_count' => 0,
                'created_at' => '2024-09-24 17:10:36',
                'updated_at' => '2024-10-30 14:02:50',
            ),
            1 => 
            array (
                'id' => 2,
                'discount_id' => 2,
                'title' => 'موبایل سامسونگ note 10',
                'slug' => 'موبایل-سامسونگ-note-10',
                'description' => 'موبایل سامسونگ note 10 اصل در سه رنگ',
                'image' => '01J8JGMRWCH4Y0SK1PPT9TVHVC.jpg',
                'price' => '20000000',
                'inventory' => 10,
                'view_count' => 0,
                'created_at' => '2024-09-24 17:18:10',
                'updated_at' => '2024-10-30 14:03:40',
            ),
            2 => 
            array (
                'id' => 3,
                'discount_id' => 1,
                'title' => 'گوشی سامسونگ مدل ultra',
                'slug' => 'گوشی-سامسونگ-مدل-ultra',
                'description' => ' گوشی سامسونگ مدل ultra
با کیفیت بسیار عالی و اصل',
                'image' => '01J8TQRREAR5ZT4MN3VC1TDNYB.jpg',
                'price' => '35000000',
                'inventory' => 10,
                'view_count' => 0,
                'created_at' => '2024-09-27 21:56:36',
                'updated_at' => '2024-10-30 14:42:31',
            ),
            3 => 
            array (
                'id' => 5,
                'discount_id' => 1,
                'title' => 'test',
                'slug' => 'test',
                'description' => 'test',
                'image' => '01JBEVP1MG2Z935YH9XE1GATM9.jpg',
                'price' => '54000000',
                'inventory' => 10,
                'view_count' => 0,
                'created_at' => '2024-10-30 14:01:14',
                'updated_at' => '2024-10-30 14:02:14',
            ),
        ));
        
        
    }
}