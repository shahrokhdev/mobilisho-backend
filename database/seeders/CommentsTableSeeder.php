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
                'id' => 1,
                'user_id' => 1,
                'commentable_id' => 1,
                'commentable_type' => 'App\\Models\\Product',
                'parent' => 0,
                'comment' => 'این نظر منه ',
                'status' => 'pending',
                'created_at' => '2024-09-25 20:41:41',
                'updated_at' => '2024-09-25 21:02:43',
            ),
        ));
        
        
    }
}