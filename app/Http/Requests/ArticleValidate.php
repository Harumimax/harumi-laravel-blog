<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Article;

class ArticleValidate extends FormRequest
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
    public function rules(Request $request)
    {
        //$article = Article::find($request->get('id'));

        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'name' => 'required|unique:articles',
                    'body' => 'required|min:1000',
                ];
            }

            case 'PATCH':
            {
                return [
                    'name' => 'required|unique:articles,name,' . $this->get('id'),
                    'body' => 'required|min:100',
                ];
            }
            case 'DELETE':
                {
                    return [];
                }

            default:break;
        }


    }
}
