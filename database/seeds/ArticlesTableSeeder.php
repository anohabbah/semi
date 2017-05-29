<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('articles')->truncate();
        factory(\App\Article::class, 50)->create([
            'niveau_id' => function () {
                return \App\Niveau::all()->random()->id;
            },
            'filiere_id' => function () {
                return \App\Filiere::all()->random()->id;
            },
        ])->each(function ($article) {
            $author = factory(\App\Auteur::class)->create();
            $article->auteurs()->save($author);
        });
    }
}
