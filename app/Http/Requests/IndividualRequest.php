<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndividualRequest extends FormRequest
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
                    'full_name' => ['required','string','max:100'],
                    'gender' => 'nullable|max:5|string',
                    'age_group' => 'nullable|string',
                    'occupation' => ['string','nullable'],
                    'city'=>'nullable|string',
                    'district'=>'nullable|string',
                    'ward'=>'nullable|string',
                    'education_level_id' => 'nullable',
                    'mobile' => ['nullable','string','min:10'],
                    'address' => ['string','nullable'],
                    'email' => ['nullable','email','max:100'],
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'full_name' => ['required','string','max:100'],
                    'gender' => 'nullable|max:5|string',
                    'age_group' => 'nullable|string',
                    'occupation' => ['string','nullable'],
                    'city'=>'nullable|string',
                    'district'=>'nullable|string',
                    'ward'=>'nullable|string',
                    'education_level_id' => 'nullable',
                    'mobile' => ['nullable','string','min:10'],
                    'address' => ['string','nullable'],
                    'email' => ['nullable','email','max:100'],
                ];
            }
        }
    }
}
