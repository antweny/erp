<?php

namespace App\Policies;

use App\Admin;
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
     * Determine whether the admin can create new resource.
     */
    public function create(Admin $admin)
    {
        return $admin->can('itemRequest-create');
    }


    /**
     * Determine whether the admin can view the resources.
     */
    public function read(Admin $admin)
    {
        return $admin->can('itemRequest-read');
    }


    /**
     * Determine whether the admin can update the question.
     */
    public function update(Admin $admin)
    {
        return $admin->can('itemRequest-update');
    }


    /**
     * Determine whether the admin can delete the question.
     */
    public function delete(Admin $admin)
    {
        return $admin->can('itemRequest-delete');
    }


    /**
     * Determine whether the admin can delete the question.
     */
    public function import(Admin $admin)
    {
        return $admin->can('itemRequest-import');
    }

    /**
     * Determine whether the admin can delete the question.
     */
    public function manage(Employee $employee, ItemRequest $itemRequest)
    {
        if($itemRequest->status == 'O')
        {
            return $employee->id === $itemRequest->employee_id;
        }
        else {
            return false;
        }
    }

}
