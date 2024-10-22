<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SupportMessagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('support_messages')->delete();
        
        \DB::table('support_messages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'ticket_id' => 1,
                'content' => 'با سلام من در قسمت ثبت نام  مشکل دارم ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 2,
                'ticket_id' => 1,
                'content' => 'سلام چه مشکلی ؟',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}