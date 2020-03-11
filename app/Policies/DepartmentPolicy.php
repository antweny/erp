<?php

namespace App\Policies;

use App\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the employee can create new resource.
     */
    public function create(Employee $employee)
    {
        return $employee->can('department-create');
    }

    /**
     * Determine whether the employee can view the resources.
     */
    public function read(Employee $employee)
    {
        return $employee->can('department-read');
    }

    /**
     * Determine whether the employee can update the question.
     */
    public function update(Employee $employee)
    {
        return $employee->can('department-update');
    }

    /**
     * Determine whether the employee can delete the question.
     */
    public function delete(Employee $employee)
    {
        return $employee->can('department-delete');
    }

    /**
     * Determine whether the employee can delete the question.
     */
    public function import(Employee $employee)
    {
        return $employee->can('department-import');
    }
}
