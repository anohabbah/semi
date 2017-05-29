<?php

namespace App;

use App\Search\Searchable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Searchable;

    /**
     * @inheritdoc
     */
    protected $fillable = ['title', 'slug', 'body', 'tags', 'filiere_id', 'niveau_id', 'published_at'];

    /**
     * @inheritdoc
     */
    protected $dates = ['published_at'];

    /**
     * @inheritdoc
     */
    protected $with = ['auteurs', 'attachment', 'filiere', 'niveau', 'categorie'];

    /**
     * @inheritdoc
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($item) {
            $item->attachment->deleteFile();
            $item->attachment()->delete();
        });
    }

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
     * un article appartient à un niveau
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

    /**
     * Brouillon
     *
     * @return mixed
     */
    public static function draft()
    {
        return static::firstOrCreate([
            'title' => null,
            'slug' => null,
            'body' => '',
            'tags' => '',

        ]);
    }

    /**
     * Enregistre les auteurs associés à au document.
     *
     * @param string $authors
     */
    public function saveAuthors(string $authors)
    {
        $authors = array_filter(
            array_unique(
                array_map(function ($item) {
                    return trim($item);
                }, explode(',', $authors))
            ),
            function ($item) {
                return !empty($item);
            }
        );

        $authorsSlugAr = array_map(function ($author) {
            return str_slug($author);
        }, $authors);

        /** @var Collection $exists */
        $exists = Auteur::whereIn('slug', $authorsSlugAr)->get();

        $toPersist = array_diff($authors, $exists->pluck('name')->all());

        $toPersist = array_map(function ($author) {
            return ['name' => $author, 'slug' => str_slug($author)];
        }, $toPersist);


        $newlyPersisted = $this->auteurs()->createMany($toPersist);
        $authors = $exists->merge($newlyPersisted);
        $this->auteurs()->sync($authors);
    }
}
