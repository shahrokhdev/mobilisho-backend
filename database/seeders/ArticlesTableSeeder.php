<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('articles')->delete();
        
        \DB::table('articles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'category_id' => 1,
                'title' => 'مقاله یک',
                'description' => 'این مقاله شماره یک است',
                'image' => '01J8T56FJ27560AJCKH09VHNFY.jpg',
                'view_count' => '0',
                'created_at' => '2024-09-27 16:32:03',
                'updated_at' => '2024-09-27 16:32:03',
            ),
            1 => 
            array (
                'id' => 2,
                'category_id' => 1,
                'title' => 'بررسی سامسونگ نوت 10',
                'description' => 'در این مقاله قصد داریم به  بررسی سامسونگ نوت 10',
                'image' => '01J8TBN3JD9Q508ZSNEZT93V5F.jpg',
                'view_count' => '0',
                'created_at' => '2024-09-27 18:24:54',
                'updated_at' => '2024-09-27 18:27:14',
            ),
            2 => 
            array (
                'id' => 3,
                'category_id' => 1,
                'title' => 'باشگاه مشتریان ',
                'description' => 'این یک مقاله درباره باشگاه مشتریان است',
                'image' => '01J8TBVYT1J2TZJ02N7YEB5P9J.jpg',
                'view_count' => '0',
                'created_at' => '2024-09-27 18:28:38',
                'updated_at' => '2024-09-27 18:28:38',
            ),
        ));
        
        
    }
}