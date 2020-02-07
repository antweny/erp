<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
                    'individual_id' => 'required',
                    'organization' => 'required|string|max:255',
                    'city' => 'nullable|string|max:255',
                    'district'=>'nullable|string|max:255',
                    'ward'=>'nullable|string|max:255',
                    'start_date' => 'required|date',
                    'end_date' => 'nullable|date|after_or_equal:start_date',
                    'desc'=>'string|nullable',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'individual_id' => 'required',
                    'organization' => 'required|string|max:255',
                    'city' => 'nullable|string|max:255',
                    'district'=>'nullable|string|max:255',
                    'ward'=>'nullable|string|max:255',
                    'start_date' => 'required|date',
                    'end_date' => 'nullable|date|after_or_equal:start_date',
                    'desc'=>'string|nullable',
                ];
            }
        }
    }
}
