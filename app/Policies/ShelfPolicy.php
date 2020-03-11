<?php

namespace App\Policies;

use App\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShelfPolicy
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
        return $employee->can('shelf-create');
    }

    /**
     * Determine whether the employee can view the resources.
     */
    public function read(Employee $employee)
    {
        return $employee->can('shelf-read');
    }

    /**
     * Determine whether the employee can update the question.
     */
    public function update(Employee $employee)
    {
        return $employee->can('shelf-update');
    }

    /**
     * Determine whether the employee can delete the question.
     */
    public function delete(Employee $employee)
    {
        return $employee->can('shelf-delete');
    }
}
