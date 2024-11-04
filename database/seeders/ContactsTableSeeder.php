<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contacts')->delete();
        
        \DB::table('contacts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'مشکل در عضویت' ,
                'full_name' => 'سعید سعیدی' ,
                'phone_number' => '09366361399',
                'message' => 'سلام مرسی از سایت خوبتون',
                'created_at' => '2024-09-25 23:18:49',
                'updated_at' => '2024-09-25 23:25:32',
            ),
        ));
        
        
    }
}
