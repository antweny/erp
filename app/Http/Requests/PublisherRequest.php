<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublisherRequest extends FormRequest
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
                    'name' => 'required|string|max:255|unique:publishers,name',
                    'mobile' => ['nullable','string'],
                    'address' => ['string','nullable'],
                    'email' => ['nullable','email','max:100'],
                    'website' => 'nullable|url',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|string|max:255|unique:publishers,id,'.$this->id,
                    'mobile' => ['nullable','string'],
                    'address' => ['string','nullable'],
                    'email' => ['nullable','email','max:100'],
                    'website' => 'nullable|url',
                ];
            }
        }
    }
}
