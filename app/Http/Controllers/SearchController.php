<?php

namespace App\Http\Controllers;

use App\Articles\ArticleRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, ArticleRepository $repository)
    {
        switch ($request->get('field')) {

            case 'si':
                $articles = new Collection();
                break;

            case 'spi':
                $articles = new Collection();
                break;

            case 'sm':
                $articles = new Collection();
                break;

            default:
                $articles = $repository->search($request->get('query'));
                break;
        }

        return $articles;
    }
}
