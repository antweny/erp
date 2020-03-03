<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __construct()
    {
    }


    /*
     * If user can read resources
     */
    public function can_read($model)
    {
        return $this->authorize('read',$model);
    }

    /*
     * If user can create a resourse
     */
    public function can_create($model)
    {
        return $this->authorize('create',$model);
    }

    /*
     * If user can update resource
     */
    public function can_update($model)
    {
        return $this->authorize('update',$model);
    }

    /*
    * If user can delete a resource
    */
    public function can_delete($model)
    {
        return $this->authorize('delete',$model);
    }

    /*
    * If user can import resources
    */
    public function can_import($model)
    {
        return $this->authorize('import',$model);
    }

    /*
    * If user can import resources
    */
    public function can_manage($model,$data)
    {
        return $this->authorize('manage',[$model,$data]);
    }

}
