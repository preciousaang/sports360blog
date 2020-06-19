<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'=>'Precious Ibeagi',
                'username'=>'preciousaang',
                'email'=>'preciousaang@gmail.com',
                'password'=>bcrypt('albert'),
                'role_id'=>1,
            ],
            [
                'name'=>'Bet Pro 360',
                'username'=>'admin',
                'password'=>bcrypt('admin'),
                'email'=>'admin@bet360pro.com',
                'role_id'=>1
            ]
        ]);
    }
}
