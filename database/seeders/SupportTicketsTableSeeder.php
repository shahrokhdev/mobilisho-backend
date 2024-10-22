<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SupportTicketsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('support_tickets')->delete();
        
        \DB::table('support_tickets')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'subject' => 'مشکل در ثبت نام',
                'priority' => 'medium',
                'attached_file' => 'تست',
                'state' => 'pending',
                'completed_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'subject' => 'مشکل در تست',
                'priority' => 'medium',
                'attached_file' => NULL,
                'state' => 'pending',
                'completed_at' => NULL,
                'created_at' => '2024-10-21 09:16:10',
                'updated_at' => '2024-10-21 09:16:10',
            ),
        ));
        
        
    }
}