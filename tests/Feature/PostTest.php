<?php

namespace Tests\Feature;

use App\Article;
use App\Auteur;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function delete_post()
    {
        $article = factory(Article::class)->create();
        $author = factory(Auteur::class)->create();
        $article->auteurs()->sync([$author->id]);

        $this->json('DELETE', route('articles.destroy', $article));

        $this->assertDatabaseMissing('articles', [
            'id' => $article->id,
            'title' => $article->title
        ]);
        $this->assertCount(0, $article->auteurs);
    }

}
