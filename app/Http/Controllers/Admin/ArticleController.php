<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Requests\ArticleRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     *
     */
    public function index()
    {
        //
    }

    /**
     * Display the model create form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $article = Article::draft();

        return view('admin.controllers.article.edit', compact('article'));
    }

    /**
     * Update the model.
     *
     * @param ArticleRequest|Request $request
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ArticleRequest $request, Article $article)
    {
         $title = $request->get('title');
         $authors = $request->get('authors');

        $exists = Article::whereSlug(str_slug($title))->first();
        if ($exists) {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['title' => 'Un document exist déjà avec cet thème.']);
        }

        $data = $this->retrieveRequestData($request);

        $article->update($data);
        $article->saveAuthors($authors);

         if ($request->has('study')) {
             $article->update(['filiere_id' => $request->get('study')]);
         }

         return redirect()->route('articles.index')
             ->with('success', 'Document enregistré avec succès.');
    }

    /**
     * @param ArticleRequest $request
     * @return array
     */
    protected function retrieveRequestData(ArticleRequest $request): array
    {
        return array_merge($request->all(), [
            'published_at' => Carbon::createFromFormat('d/m/Y', $request->get('published_at')),
            'slug' => str_slug($request->get('title')),
        ]);
    }
}
