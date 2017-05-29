<?php

namespace App\Http\Controllers\Admin;

use App\Auteur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    public function authors(Request $request)
    {
        $term = $request->get('term');
        return Auteur::select('name')->where('name', 'LIKE', $term . '%')->get()
            ->map(function ($tag) {
                return [
                    'id' => $tag->name,
                    'label' => $tag->name,
                    'value' => $tag->name,
                ];
            });
    }
}
