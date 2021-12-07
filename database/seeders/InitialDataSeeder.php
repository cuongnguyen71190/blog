<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Str;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Password123!'),
            'remember_token' => Str::random(10),
            'is_admin' => 1
        ]);

         Post::create([
             'title' => 'The first post',
             'content' => '#content of first post',
             'user_id' => 1
         ]);
    }
}
