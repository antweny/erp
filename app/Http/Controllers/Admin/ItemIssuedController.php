<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemIssuedRequest;
use App\ItemIssued;
use App\Item;
use Illuminate\Support\Facades\DB;

class ItemIssuedController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(ItemIssued $itemIssued)
    {
        $this->authorize('read',$itemIssued);
        try {
            $itemIssueds = $itemIssued->orderBy('date_issued','desc')->with('employee','item')->get();
            return view('store.itemIssued.index',compact('itemIssueds'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ItemIssued $itemIssued)
    {
        $this->authorize('create',$itemIssued);
        try {
            return $this->populate(__FUNCTION__, $itemIssued);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemIssuedRequest $request, ItemIssued $itemIssued)
    {
        $this->authorize('create',$itemIssued);
        $request['status'] = 'I';

        DB::beginTransaction();
        try {
            $this->decrement_item_quantity($request);    //Reduced quantity number on item on issuee
            $itemIssued->create($request->all());
            DB::commit();
            return back()->with('success','Item has been issued');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error','Something went wrong')->withInput($request->input());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('update',$this->model());
        try {
            $itemIssued = $this->getID($id);
            return $this->populate(__FUNCTION__, $itemIssued);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemIssuedRequest $request, $id)
    {
        $this->authorize('update',$this->model());
        DB::beginTransaction();
        try {
            $request['status'] = 'I';

            $itemIssued = $this->getID($id); //Get delatis of updating item received
            //Check if user update the item received quqntity
            if($request->quantity != $itemIssued->quantity)
            {
                $this->update_item_quantity($request,$itemIssued->quantity);
            }
            $itemIssued->update($request->all());
            DB::commit();
            return redirect()->route('itemIssued.index')->with('success','Item Issued has been Updated');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error',' Something went wrong')->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('delete',$this->model());
        try {
            $itemIssued = $this->getID($id);

            //Update the Item Table
            $this->increment_item_quantity($itemIssued->item_id,$itemIssued->quantity);
            $itemIssued->delete();
            DB::commit();
            return redirect()->route('itemIssued.index')->with('success','Issued Item has been deleted');
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
    public function populate($function_name, $itemIssued) {

        $items = Item::quantity_greater_than_zero(); //Get List of items
        $employees = Employee::get_full_name_and_id();

        $data = compact('items','itemIssued','employees');
        return view('store.itemIssued.'.$function_name , $data);
    }

    /*
     * Get requested record ID
     */
    public function getID($id)
    {
        $data = ItemIssued::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controller model class
     */
    public function model ()
    {
        return ItemIssued::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('itemIssued.index')->with('error','something went wrong');
    }


}
