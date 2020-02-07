<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
                    'name' => 'required|string|max:100|unique:events,name',
                    'venue'=>'nullable|string',
                    'event_category_id' => 'required',
                    'employee_id' => 'required',
                    'organization_id' => 'required',
                    'individual_id' => 'nullable',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date|after_or_equal:start_date',
                    'objectives' => 'required|string',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|string|max:100|unique:events,id,'.$this->event->id,
                    'venue'=>'nullable|string',
                    'event_category_id' => 'required',
                    'employee_id' => 'required',
                    'organization_id' => 'required',
                    'individual_id' => 'nullable',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date|after_or_equal:start_date',
                    'objectives' => 'required|string',
                ];
            }
        }
    }
}
