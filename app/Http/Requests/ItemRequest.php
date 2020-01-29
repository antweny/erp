<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
                    'name' => 'required|string|max:255|unique:items,name',
                    'desc' => 'string|nullable',
                    'item_category_id' => 'nullable',
                    'item_unit_id' => 'nullable',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|string|max:255|unique:items,id,'.$this->item->id,
                    'desc' => 'string|nullable',
                    'item_category_id' => 'nullable',
                    'item_unit_id' => 'nullable',
                ];
            }
        }
    }
}
