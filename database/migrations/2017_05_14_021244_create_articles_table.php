<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->string('tags');
            $table->unsignedInteger('niveau_id')->nullable();
            $table->unsignedInteger('filiere_id')->nullable();
            $table->unsignedInteger('categorie_id')->nullable();
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('body');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->foreign('niveau_id')->references('id')->on('niveaus')->onDelete('cascade');
            $table->foreign('filiere_id')->references('id')->on('filieres')->onDelete('cascade');
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::create('article_auteur', function (Blueprint $table) {
            $table->unsignedInteger('article_id');
            $table->unsignedInteger('auteur_id');
            $table->primary(array('article_id','auteur_id'));
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('auteur_id')->references('id')->on('auteurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_auteur');
        Schema::dropIfExists('articles');
    }
}
