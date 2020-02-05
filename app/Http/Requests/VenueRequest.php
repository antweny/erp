<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VenueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
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
                    'name' => 'required|string|max:255|unique:venues,name',
                    'phone'=>'numeric|nullable',
                    'email'=>'email|nullable',
                    'city_id' => 'nullable',
                    'type' => 'string|nullable',
                    'capacity' => 'integer|nullable',
                    'district_id'=>'nullable',
                    'contact_person' => 'string|nullable|max:50',
                    'contact_person_number'=>'numeric|nullable',
                    'desc'=>'string|nullable',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|string|max:255|unique:venues,id,'.$this->venue->id,
                    'phone'=>'numeric|nullable',
                    'email'=>'email|nullable',
                    'city_id' => 'nullable',
                    'type' => 'string|nullable',
                    'capacity' => 'integer|nullable',
                    'district_id'=>'nullable',
                    'contact_person' => 'string|nullable|max:50',
                    'contact_person_number'=>'numeric|nullable',
                    'desc'=>'string|nullable',
                ];
            }
        }
    }
}
