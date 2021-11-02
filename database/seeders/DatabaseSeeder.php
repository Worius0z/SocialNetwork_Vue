<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(7)->hasProfile()->hasPosts(1)->create();
        \App\Models\Comment::factory(2)->create();
    }
}
