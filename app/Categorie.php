<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
