<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
                    'title' => 'required|string',
                    'employee_id' => 'required',
                    'ticket_category_id' => 'nullable',
                    'priority' => 'nullable:string|max:5',
                    'status' => 'nullable:string|max:5',
                    'desc' => 'nullable|string',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'title' => 'required|string',
                    'employee_id' => 'required',
                    'ticket_category_id' => 'nullable',
                    'priority' => 'nullable:string|max:5',
                    'status' => 'nullable:string|max:5',
                    'desc' => 'nullable|string',
                ];
            }
        }
    }
}
