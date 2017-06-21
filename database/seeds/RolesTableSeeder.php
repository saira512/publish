<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            
        $data=[
               [
                 'title' => 'Admin',
                 'description' => 'This user is an admin',
               ],

               [
                  'title' => 'Member',
                  'description' => 'This user is a member',
               ]
             ] ;    
        DB::table('roles')->insert($data);
    }
}
