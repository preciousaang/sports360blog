<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([

            [
                'title'=>'admin',
                'full_name'=>'Administrator'
            ],
            [
                'title'=>'editor',
                'full_name'=>'Editor'
            ],
            [
                'title'=>'author',
                'full_name'=>'Author'
            ],
            [
                'title'=>'subscriber',
                'full_name'=>'Subscriber'
            ]
        ]);
    }
}
