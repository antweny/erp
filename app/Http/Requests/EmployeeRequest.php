<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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

                    'employee_no' => 'required|string|unique:employees,employee_no',
                    'first_name' => 'required|string|max:20',
                    'middle_name' => 'required|string|max:20',
                    'last_name' => 'required|string|max:20',
                    'dob' => 'required|date',
                    'email' => 'required|email|unique:employees,email',
                    'mobile' => 'required',
                    'department_id' => 'required',
                    'hire_date' => 'required|date',
                    'admin_id' => 'nullable|unique:employees,admin_id',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'employee_no' => 'required|string|unique:employees,id,'.$this->employee->id,
                    'first_name' => 'required|string|max:20',
                    'middle_name' => 'required|string|max:20',
                    'last_name' => 'required|string|max:20',
                    'dob' => 'required|date',
                    'email' => 'required|email|unique:employees,id,'.$this->employee->id,
                    'mobile' => 'required',
                    'department_id' => 'required',
                    'hire_date' => 'required|date',
                    'admin_id' => 'nullable|unique:employees,id,'.$this->employee->id,
                ];
            }
        }
    }
}
