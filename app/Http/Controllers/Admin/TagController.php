<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function tags(Request $request)
    {
        $term = $request->get('term');
        return Tag::select('name')->where('name', 'LIKE', $term . '%')->get()
            ->map(function ($tag) {
                return [
                    'id' => $tag->name,
                    'label' => $tag->name,
                    'value' => $tag->name,
                ];
            });
    }
}
