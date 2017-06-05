<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Filiere;
use App\Http\Datatable\SSP;
use App\Http\Requests\ArticleRequest;
use App\Niveau;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     *
     */
    public function index()
    {
        return view('admin.controllers.article.index');
    }

    /**
     * Load Documents data by ajax request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function doAjaxLoading(Request $request)
    {
        /**
         * DataTables example server-side processing script.
         *
         * Please note that this script is intentionally extremely simply to show how
         * server-side processing can be implemented, and probably shouldn't be used as
         * the basis for a large complex system. It is suitable for simple use cases as
         * for learning.
         *
         * See http://datatables.net/usage/server-side for full details on the server-
         * side processing requirements of DataTables.
         *
         * @license MIT - http://datatables.net/license_mit
         */

        /** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
         */

        // DB table to use
        $table = env('DB_PREFIX', '') . 'articles';

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case object
        // parameter names
        $columns = array(
            array(
                'db' => 'id',
                'dt' => 'name',
                'formatter' => function ($d, $row) {
                    $doc = Article::find($d);
                    return $doc->auteurs->implode('name', ',');
                }
            ),
            array('db' => 'title', 'dt' => 'title'),
            array(
                'db' => 'id',
                'dt' => 'study',
                'formatter' => function ($d, $row) {
                    $doc = Article::find($d);
                    return $doc->filiere->name;
                }
            ),
            array(
                'db' => 'published_at',
                'dt' => 'published_at',
                'formatter' => function ($d, $row) {
                    return date('d/m/Y', strtotime($d));
                }
            ),
            array(
                'db' => 'id',
                'dt' => 'actions',
                'formatter' => function ($d, $row) {
                    $id = 'delete_form_' . $d;
                    return '<div class="btn-group btn-group-xs" >
                              <a href="' . route("articles.edit", $d) . '" class="btn btn-default" data-toggle="tooltip" data-placement="top" type="button" title="Modifier"><i class="glyphicon glyphicon-edit"></i></a >
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropmenu_'. $d .'" data-toggle="dropdown">
                                  <i class="caret"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropmenu_'. $d .'">
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="event.preventDefault();document.getElementById(\''. $id .'\').submit()"><i class="glyphicon glyphicon-trash"></i> Supprimer</a></li>
                                  <form action="'. route("articles.destroy", $d) .'" id="' . $id . '" method="post">'. csrf_field() . method_field("delete") .'</form>
                                </ul>
                            </div >';
                }
            ),
        );

        // SQL server connection information
        $sql_details = array(
            'driver' => env('DB_CONNECTION'),
            'user' => env('DB_USERNAME'),
            'pass' => env('DB_PASSWORD'),
            'db' => env('DB_DATABASE'),
            'host' => env('DB_HOST')
        );

        $whereAll = 'title is not null and slug is not null';


        /** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */

        return new JsonResponse(
            SSP::complex($request->all(), $sql_details, $table, $primaryKey, $columns, null, $whereAll)
        );
    }

    /**
     * Display the model create form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $article = Article::draft();
        $action = 'create';

        return view('admin.controllers.article.edit', compact('article', 'action'));
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

        //  Nous ne verifions pas si l'article existe lors d'une mise à jour.
        if ($request->has('action') && $request->get('action') === 'create') {
            $exists = Article::whereSlug(str_slug($title))->first();
            if ($exists) {
                return redirect()->back()
                    ->withInput($request->all())
                    ->withErrors(['title' => 'Un document de thème identique exist déjà.']);
            }
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
     * @param ArticleRequest|array $request
     * @return array
     */
    protected function retrieveRequestData(ArticleRequest $request): array
    {
        return array_merge($request->only(['title', 'tags', 'published_at', 'body', 'niveau_id']),
            [
                'published_at' => Carbon::createFromFormat('d/m/Y', $request->get('published_at')),
                'slug' => str_slug($request->get('title')),
            ]);
    }

    /**
     * Display edit form.
     *
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Article $article)
    {
        $action = 'edit';

        return view('admin.controllers.article.edit', compact('article', 'action'));
    }

    public function destroy(Article $article)
    {
        $article->delete();
    }
}
