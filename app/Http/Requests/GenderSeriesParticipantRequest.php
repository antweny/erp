<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenderSeriesParticipantRequest extends FormRequest
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
                    'gender_series_id' => 'required',
                    'individual_id' => 'required',
                    'organization_id'=>'nullable',
                    'ward_id' => 'nullable|integer',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'gender_series_id' => 'required',
                    'individual_id' => 'required',
                    'organization_id'=>'nullable',
                    'ward_id' => 'nullable|integer',
                ];
            }
        }
    }
}
