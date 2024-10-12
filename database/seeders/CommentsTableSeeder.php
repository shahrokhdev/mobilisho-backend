<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('comments')->delete();
        
        \DB::table('comments')->insert(array (
            0 => 
            array (
                'id' => 5,
                'user_id' => 2,
                'commentable_id' => 2,
                'commentable_type' => 'App\\Models\\Product',
                'parent' => 0,
                'comment' => 'سلام قیمت چند ؟',
                'status' => 'approved',
                'created_at' => '2024-09-25 20:41:41',
                'updated_at' => '2024-10-06 22:07:47',
            ),
            1 => 
            array (
                'id' => 6,
                'user_id' => 2,
                'commentable_id' => 2,
                'commentable_type' => 'App\\Models\\Product',
                'parent' => 0,
                'comment' => 'سلام قیمت چند ؟',
                'status' => 'approved',
                'created_at' => '2024-09-25 20:41:41',
                'updated_at' => '2024-10-06 22:07:47',
            ),
        ));
        
        
    }
}