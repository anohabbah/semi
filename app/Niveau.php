<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;

    /**
     * Relation avec les articles.
     * Il peut avoir plusieurs articles publiés pour un même niveau académique.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
