<?php

use App\Book;
use App\Download;
use App\favorite;
use App\library;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(UserSeeder::class);
        // \App\Models\User::factory(10)->create();
//
//        \App\User::factory(10)->create();
//        \App\library::factory(10)->create();
//        \App\favorite::factory(10)->create();
//        \App\Book::factory(10)->create();
//        \App\Download::factory(10)->create();
        $this->call([
            BookSeeder::class,
            UserSeeder::class,

        ]);

    }
}
