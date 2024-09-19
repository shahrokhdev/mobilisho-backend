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
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$LzXsZ.zfbzenH8Kolszd2ekIyJlf8PMY0uh4QMJJTyRy8jn7tUaxW',
                'phone_number' => '09903478085',
                'state' => 'active',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'created_at' => '2024-09-17 20:46:10',
                'updated_at' => '2024-09-17 22:14:29',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'shahrokh',
                'username' => 'shahrokhdev',
                'email' => 'shahrokh@gmail.com',
                'password' => '$2y$10$jGRwviBwMZ6/30r4xqkSNe8ypM6fp9fuYPkP.6Ux9ZzLcnaEWYD1e',
                'phone_number' => '09366461399',
                'state' => 'active',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'created_at' => '2024-09-17 21:28:33',
                'updated_at' => '2024-09-17 22:15:22',
            ),
        ));
        
        
    }
}