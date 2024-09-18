<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$J0Zw11Zu2wH8mceHsxxhy.aTnQvFAqVOZuDYDA3Aouu57/sWw3Wb.',
                'remember_token' => NULL,
                'created_at' => '2024-09-17 20:46:10',
                'updated_at' => '2024-09-17 20:46:10',
            ),
        ));
        
        
    }
}