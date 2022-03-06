<?php

use App\book;
use App\downloded;
use App\favorite;
use App\library;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // \App\Models\User::factory(10)->create();
        User::truncate();
        book::truncate();
        library::truncate();
        favorite::truncate();
        downloded::truncate();
        \App\User::factory(10)->create();
        \App\library::factory(10)->create();
        \App\favorite::factory(10)->create();
        \App\book::factory(10)->create();
        \App\downloded::factory(10)->create();

    }
}
