<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\ItemRequestRequest;
use App\ItemRequest;
use App\Item;
use Illuminate\Support\Facades\DB;

class ItemRequestController extends Controller
{
    /**
     * Auth constructor.
     */
    function __construct()
    {
        $this->middleware('auth:admin',['only'=> ['index','create','store','edit','update','destroy','itemIssued']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ItemRequest $itemRequest)
    {
        $this->authorize('read',$itemRequest);
        try {
            $itemRequests = $itemRequest->latest()->where('status','O')->with('employee','item')->get();
            return view('store.requests.index',compact('itemRequests'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function itemIssued(ItemRequest $itemRequest)
    {
        $this->authorize('read',$itemRequest);
        try {
            $itemRequests = $itemRequest->latest()->where('status','C')->with('employee','item')->get();
            return view('store.requests.issued',compact('itemRequests'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ItemRequest $itemRequest)
    {
        $this->authorize('create',$itemRequest);
        try {
            return $this->populate(__FUNCTION__,$itemRequest);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequestRequest $request, ItemRequest $itemRequest)
    {
        $this->authorize('create',$itemRequest);
        $request['status'] = 'C';
        DB::beginTransaction();
        try {
            //dd($request->only('employee_id'));
            $this->decrement_item_quantity($request);    //Reduced quantity number on item on issuee

            $itemRequest->create($request->all());
            DB::commit();
            return back()->with('success','Item Request has been added');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error',$e->getMessage())->withInput($request->input());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('update',$this->model());
        try {
            $itemRequest = $this->getID($id);
            return $this->populate(__FUNCTION__, $itemRequest);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequestRequest $request, $id)
    {
        $this->authorize('update',$this->model());
        $request['status'] = 'C';
        DB::beginTransaction();
        try {
            $itemRequest = $this->getID($id); //Get delatis of updating item received
            if($request->quantity != $itemRequest->quantity)  //Check if user update the item received quqntity
            {
                $this->update_item_quantity($request,$itemRequest->quantity);
            }
            $itemRequest->update($request->all());
            DB::commit();
            return redirect()->route('itemRequests.index')->with('success','Item Request has been Updated');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error',$e->getMessage())->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('delete',$this->model());
        try {
            $itemRequest = $this->getID($id);

            //Update the Item Table
            $this->increment_item_quantity($itemRequest->item_id,$itemRequest->quantity);
            $itemRequest->delete();
            DB::commit();
            return redirect()->route('itemRequests.index')->with('success','Request Item has been deleted');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return $this->errorReturn();
        }
    }

    /*
    * Reduce number of quantity on item when issued
    */
    public function decrement_item_quantity ($request)
    {
        $item = $this->get_item_id($request['item_id']);

        return $item->decrement('quantity',$request['quantity']);
    }

    /*
     * Update the Item Quantity when updating issued quantity
     */
    public function update_item_quantity ($request,$quantity)
    {
        $item = $this->get_item_id($request['item_id']);
        $item->increment('quantity',$quantity);
        return $item->decrement('quantity',$request['quantity']);
    }

    /*
     * Delete the Item Quantity
     */
    public function increment_item_quantity ($id, $quantity)
    {
        $item = $this->get_item_id($id);
        return $item->increment('quantity',$quantity);
    }

    /*
     * Get Item ID
     */
    public function get_item_id ($id)
    {
        $item = Item::findOrFail($id);
        return $item;
    }

    /*
    * Populate dropdowns values from different tables and return to forms
    */
    public function populate($function_name, $itemRequest)
    {
        $items = Item::quantity_greater_than_zero(); //Get List of items
        $employees = Employee::get_full_name_and_id();
        $data = compact('items','itemRequest','employees');
        return view('store.requests.'.$function_name,$data);
    }

    /*
     * Get requested record ID
     */
    public function getID($id)
    {
        $data = ItemRequest::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controller model class
     */
    public function model ()
    {
        return ItemRequest::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('itemRequests.index')->with('error','something went wrong');
    }

}
