<?php

namespace App\Policies;

use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemIssuedPolicy
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
        return $admin->can('itemIssued-create');
    }


    /**
     * Determine whether the admin can view the resources.
     */
    public function read(Admin $admin)
    {
        return $admin->can('itemIssued-read');
    }


    /**
     * Determine whether the admin can update the question.
     */
    public function update(Admin $admin)
    {
        return $admin->can('itemIssued-update');
    }


    /**
     * Determine whether the admin can delete the question.
     */
    public function delete(Admin $admin)
    {
        return $admin->can('itemIssued-delete');
    }


    /**
     * Determine whether the admin can delete the question.
     */
    public function import(Admin $admin)
    {
        return $admin->can('itemIssued-import');
    }

}
