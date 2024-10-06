<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tickets')->delete();
        
        \DB::table('tickets')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'title' => 'test',
                'description' => 'this is test ',
                'priority' => 'low',
                'state' => 'pending',
                'attached_file' => '01J8QRR90F4TNRBAXNCXDJ93GZ.jpg',
                'created_at' => '2024-09-26 18:16:06',
                'updated_at' => '2024-09-26 18:16:06',
            ),
        ));
        
        
    }
}