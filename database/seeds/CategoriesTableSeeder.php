<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'title'=>'General',
            ],
            [
                'title'=>'Football News',
            ],
            [
                'title'=>'Sports Lifestyle'
            ]
        ]);
    }
}