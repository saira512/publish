<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
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
                  'name' => 'NOTICES_EDIT',
                   'display_name' => 'edit notice',
                   'description' => '',
                ],

                [
                   'name' => 'NOTICES_VIEW',
                   'display_name' => 'view notice',
                   'description' => '',
                ],

                [
                   'name' => 'NOTICES_APPROVE',
                   'display_name' => 'approve notice',
                   'description' => '',
                ],
                [
                   'name' => 'NOTICES_CREATE',
                   'display_name' => 'create notice',
                   'description' => '',
                ],
                [
                   'name' => 'NOTICES_REMOVE',
                   'display_name' => 'remove notice',
                   'description' => '',
                ]

             ] ; 
        DB::table('permissions')->insert($data);
    }
}
