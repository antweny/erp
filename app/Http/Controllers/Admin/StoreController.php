<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ItemIssued;
use Illuminate\Http\Request;

class StoreController extends Controller
{

    public function __invoke(ItemIssued $itemIssued)
    {
        //if (auth()->user()->hasAnyRole(['superAdmin', 'Store Manager']) ) {

            $itemIssueds = $itemIssued->orderBy('date_issued','desc')->with('employee','item')->get();

            return view('store.itemIssued.index',compact('itemIssueds'));
        //}
        //else {
        //    $itemIssueds = $itemIssued->where('employee_id',auth()->user()->employee->id)->orderBy('date_issued','desc')->with('employee','item')->get();

         //   return view('items.requests.index',compact('itemIssueds'));
        //}

    }
}
