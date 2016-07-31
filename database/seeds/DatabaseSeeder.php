<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        //
        // category
        DB::table('category')->insert([
        	'title' => 'PHP',
        	'slug'	=> 'php',
        	'description' => 'Lorem ipsum Laborum occaecat dolor do id laborum dolor in in qui commodo reprehenderit magna.'
        ]);
        DB::table('category')->insert([
        	'title' => 'Java',
        	'slug'	=> 'java',
        	'description' => 'Lorem ipsum Aliquip veniam ea Duis laborum dolor dolore voluptate quis consequat fugiat nostrud.'
        ]);
        DB::table('category')->insert([
        	'title' => 'Javascript',
        	'slug'	=> 'javascript',
        	'description' => 'Lorem ipsum Sint magna culpa mollit fugiat cupidatat magna ex dolor culpa.'
        ]);
        DB::table('category')->insert([
        	'title' => 'Html5',
        	'slug'	=> 'html5',
        	'description' => 'Lorem ipsum Voluptate ut aliquip laboris voluptate ut ex in est do esse dolore labore.'
        ]);
        DB::table('category')->insert([
        	'title' => 'Cấu trúc dữ liệu và giải thuật',
        	'slug'	=> 'cau-truc-du-lieu-va-giai-thuat',
        	'description' => 'Lorem ipsum Pariatur eu dolor nulla officia esse occaecat dolor in commodo occaecat consectetur anim dolor dolor.'
        ]);
        DB::table('category')->insert([
        	'title' => 'Css3',
        	'slug'	=> 'css3',
        	'description' => 'Lorem ipsum Sit dolor cillum dolore dolor officia do deserunt elit eu irure occaecat laborum nulla nostrud sit enim incididunt.'
        ]);
        DB::table('users')->insert([
            'name' => 'ohmygodvt95',
            'email' => 'ohmygodvt95@gmail.com',
            'password' => bcrypt('thien@123'),
            'role' => 'admin'
        ]);
        DB::table('levels')->insert([
            'title' => 'Dễ'
        ]);
        DB::table('levels')->insert([
            'title' => 'Trung bình'
        ]);
        DB::table('levels')->insert([
            'title' => 'Khó'
        ]);
        DB::table('levels')->insert([
            'title' => 'Rất khó'
        ]);
    }
}
