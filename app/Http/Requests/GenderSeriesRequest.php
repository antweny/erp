<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenderSeriesRequest extends FormRequest
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
                    'topic' => 'required|string|',
                    'coordinator' => 'required',
                    'facilitator'=>'required',
                    'date' => 'required|date',
                    'follow_up' => 'nullable|string',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'topic' => 'required|string|',
                    'coordinator' => 'required',
                    'facilitator'=>'required',
                    'date' => 'required|date',
                    'follow_up' => 'nullable|string',
                ];
            }
        }
    }
}
