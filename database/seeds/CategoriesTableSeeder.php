<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Article', 'Mémoire'];

        collect($categories)->each(function ($category) {
            \App\Categorie::create(['name' => $category]);
        });
    }
}
