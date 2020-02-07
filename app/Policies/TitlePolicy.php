<?php

namespace App\Policies;

use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class TitlePolicy
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
        return $admin->can('title-create');
    }


    /**
     * Determine whether the admin can view the resources.
     */
    public function read(Admin $admin)
    {
        return $admin->can('title-read');
    }


    /**
     * Determine whether the admin can update the question.
     */
    public function update(Admin $admin)
    {
        return $admin->can('title-update');
    }


    /**
     * Determine whether the admin can delete the question.
     */
    public function delete(Admin $admin)
    {
        return $admin->can('title-delete');
    }


    /**
     * Determine whether the admin can import the question.
     */
    public function import(Admin $admin)
    {
        return $admin->can('title-import');
    }


}