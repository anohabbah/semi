<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required|string|max:225',
            'tags'          => 'required|string|max:225',
            'authors'       => 'required|string|max:225',
            'body'          => 'required',
            'published_at'  => 'date_format:d/m/Y|before:today',
//            'file' => 'required|file',
        ];
    }
}
