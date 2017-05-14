<?php
/**
 * Created by PhpStorm.
 * User: FXLABO
 * Date: 13/05/2017
 * Time: 01:16
 */

namespace App\Articles;


use Illuminate\Database\Eloquent\Collection;

interface ArticleRepository
{
    public function search(string $query = ""): Collection;
}