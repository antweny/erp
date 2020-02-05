<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
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
                    'name' => 'required|string|max:191|unique:organizations,name',
                    'acronym' => 'nullable|string|max:15',
                    'founded'=>'nullable|integer',
                    'registered'=>'nullable|integer',
                    'organization_category_id'=>'nullable',
                    'operation_level'=>'nullable|string|max:5',
                    'city_id'=>'nullable',
                    'district_id'=>'nullable',
                    'ward_id'=>'nullable',
                    'address' =>'nullable|string',
                    'website' => 'nullable|url',
                    'email'=>'nullable|email',
                    'mobile' => 'numeric|nullable',
                    'phone' => 'numeric|nullable',
                    'objectives' => 'string|nullable',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|string|max:100|unique:organizations,name,'.$this->organization->id,
                    'acronym' => 'nullable|string|max:15',
                    'founded'=>'nullable|integer',
                    'registered'=>'nullable|integer',
                    'organization_category_id'=>'nullable',
                    'operation_level'=>'nullable|string|max:5',
                    'city_id'=>'nullable',
                    'district_id'=>'nullable',
                    'ward_id'=>'nullable',
                    'address' =>'nullable|string',
                    'website' => 'nullable|url',
                    'email'=>'nullable|email',
                    'mobile' => 'numeric|nullable',
                    'phone' => 'numeric|nullable',
                    'objectives' => 'string|nullable',
                ];
            }
        }
    }
}
