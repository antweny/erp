<?php

namespace App\Policies;

use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventCategoryPolicy
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
    public function create(Admin $employee)
    {
        return $employee->can('eventCategory-create');
    }

    /**
     * Determine whether the employee can view the resources.
     */
    public function read(Admin $employee)
    {
        return $employee->can('eventCategory-read');
    }

    /**
     * Determine whether the employee can update the question.
     */
    public function update(Admin $employee)
    {
        return $employee->can('eventCategory-update');
    }

    /**
     * Determine whether the employee can delete the question.
     */
    public function delete(Admin $employee)
    {
        return $employee->can('eventCategory-delete');
    }
}
