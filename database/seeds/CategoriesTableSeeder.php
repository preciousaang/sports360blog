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
                'slug'=>'general'
            ],
            [
                'title'=>'Football News',
                'slug'=>'football-news'
            ],
            [
                'title'=>'Sports Lifestyle',
                'slug'=>'sports-lifestyle'
            ],
            [
                'title'=>'Match Previews',
                'slug'=>'match-previews'
            ]
        ]);
    }
}
