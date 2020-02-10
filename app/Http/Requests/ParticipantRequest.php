<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipantRequest extends FormRequest
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
                    'event_id' => 'required',
                    'individual_id' => 'required',
                    'organization_id'=>'nullable',
                    'participant_role_id'=>'nullable',
                    'group_id'=>'nullable',
                    'ward' => 'nullable|string',
                    'level' => 'nullable|string|max:2',
                    'date' => 'required|date',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'event_id' => 'required',
                    'individual_id' => 'required',
                    'organization_id'=>'nullable',
                    'participant_role_id'=>'nullable',
                    'group_id'=>'nullable',
                    'ward' => 'nullable|string',
                    'level' => 'nullable|string|max:2',
                    'date' => 'required|date',
                ];
            }
        }
    }
}
