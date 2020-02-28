<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:admins',
                    'password' => 'required|string|min:8|confirmed',
                    'roles' => 'required',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:admins,id,'.$this->id,
                    'roles' => 'required',
                ];
            }
        }
    }
}
