<?php

namespace App\Policies;

use App\Employee;
use App\ItemRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemRequestPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
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
        return $employee->can('itemRequest-create');
    }


    /**
     * Determine whether the employee can view the resources.
     */
    public function read(Employee $employee)
    {
        return $employee->can('itemRequest-read');
    }


    /**
     * Determine whether the employee can update the question.
     */
    public function update(Employee $employee)
    {
        return $employee->can('itemRequest-update');
    }


    /**
     * Determine whether the employee can delete the question.
     */
    public function delete(Employee $employee)
    {
        return $employee->can('itemRequest-delete');
    }


    /**
     * Determine whether the employee can delete the question.
     */
    public function import(Employee $employee)
    {
        return $employee->can('itemRequest-import');
    }

}
