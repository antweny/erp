<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipantRoleRequest extends FormRequest
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
                    'name' => 'required|string|max:255|unique:participant_roles,name',
                    'desc' => 'string|nullable',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|string|max:255|unique:participant_roles,id,'.$this->id,
                    'desc' => 'string|nullable',
                ];
            }

        }
    }
}
