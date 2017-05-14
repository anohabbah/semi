<?php

namespace App;

use App\Search\Searchable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Searchable;

    /**
     * un auteur à plusieurs articles
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function auteurs()
    {
        return $this->belongsToMany(Auteur::class);
    }

    /**
     * un article appartient a une filiere
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }


    /**
     * un article appartient à un nivau
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function attachment()
    {
        return $this->morphOne(Attachment::class,'attachable');
    }
}
