<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobHistoryRequest extends FormRequest
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
                    'employee_id' => 'required',
                    'designation_id' => 'required',
                    'job_type_id' => 'nullable',
                    'start_date' => 'required|date',
                    'end_date' => 'nullable|date|after_or_equal:start_date',

                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'employee_id' => 'required',
                    'designation_id' => 'required',
                    'job_type_id' => 'nullable',
                    'start_date' => 'required|date',
                    'end_date' => 'nullable|date|after_or_equal:start_date',
                ];
            }
        }
    }
}
