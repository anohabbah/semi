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
        $this->call(CategoriesTableSeeder::class);
        $this->call(FilieresTableSeeder::class);
        $this->call(NiveausTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
    }
}
