<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auteur extends Model
{
    protected $fillable = ['name', 'slug', 'email'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
