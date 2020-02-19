<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequestRequest extends FormRequest
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
                    'date_issued' => 'date|nullable',
                    'item_id' => 'required',
                    'quantity' => 'integer',
                    'required' => 'required|integer',
                    'employee_id' => 'required',
                    'desc' => 'string|nullable',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'date_issued' => 'date|nullable',
                    'item_id' => 'required',
                    'quantity' => 'integer',
                    'required' => 'required|integer',
                    'employee_id' => 'required',
                    'desc' => 'string|nullable',
                ];
            }

        }
    }
}
