<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicationRequest extends FormRequest
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
        switch ($this->method())
        {

            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'title' => 'required|string',
                    'publication_category_id'=>'nullable',
                    'author_id' => 'nullable',
                    'publisher_id' => 'nullable',
                    'shelf_id' => 'nullable',
                    'genre_id' => 'nullable',
                    'class_number' => 'nullable|numeric',
                    'year' => 'nullable|integer',
                    'desc' => 'nullable|string',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'title' => 'required|string',
                    'publication_category_id'=>'nullable',
                    'author_id' => 'nullable',
                    'publisher_id' => 'nullable',
                    'shelf_id' => 'nullable',
                    'genre_id' => 'nullable',
                    'class_number' => 'nullable|numeric',
                    'year' => 'nullable|integer',
                    'desc' => 'nullable|string',
                ];
            }
        }
    }
}
