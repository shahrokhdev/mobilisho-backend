<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArticleCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('article_categories')->delete();
        
        \DB::table('article_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'تکنولوژی',
                'slug' => 'تکنولوژی',
                'image' => '01J8T588HBFR1GB2323PBSPTCM.jpg',
                'created_at' => '2024-09-27 16:33:02',
                'updated_at' => '2024-09-27 16:33:02',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'موبایلیشو',
                'slug' => 'موبایلیشو',
                'image' => '01J8TBTHAQFA6D714SN6JZ9MTV.jpg',
                'created_at' => '2024-09-27 18:27:52',
                'updated_at' => '2024-09-27 18:27:52',
            ),
        ));
        
        
    }
}