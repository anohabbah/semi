<?php
/**
 * Created by PhpStorm.
 * User: FXLABO
 * Date: 13/05/2017
 * Time: 01:21
 */

namespace App\Articles;


use App\Article;
use Illuminate\Database\Eloquent\Collection;

class EloquentArticleRepository implements ArticleRepository
{

    public function search(string $query = ""): Collection
    {
        return Article::where('body', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->get();
    }
}