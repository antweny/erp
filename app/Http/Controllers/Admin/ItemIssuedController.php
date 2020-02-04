<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemIssuedRequest;
use App\ItemIssued;
use App\Item;

class ItemIssuedController extends Controller
{
    /**
     * AdminController constructor.
     */
    function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ItemIssued $itemIssued)
    {
        $this->authorize('read',$itemIssued);

        $itemIssueds = $itemIssued->orderBy('date_issued','desc')->with('employee','item')->get();

        return view('items.issued.index',compact('itemIssueds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ItemIssued $itemIssued)
    {
        $this->authorize('create',$itemIssued);

        $items = Item::quantity_greater_than_zero(); //Get List of items

        $employees = Employee::get_full_name_and_id();

        return view('items.issued.create',compact('items','itemIssued','employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemIssuedRequest $request, ItemIssued $itemIssued)
    {
        $this->authorize('create',$itemIssued);

        $request['status'] = 'I';

        //Increment the Item Quantity
        if ($this->reduce_item_quantity_on_creating($request->item_id, $request->quantity) == true ) {

            $itemIssued = $itemIssued->create($request->all());

            return back()->with('success','Item has been issued');
        }
        else {
            return back()->withInput($request->input())->with('error','Sorry the Quantity requested is greaterr than the remain quantity!');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemIssued $itemIssued)
    {
        $this->authorize('update',$itemIssued);

        $items = Item::quantity_greater_than_zero(); //Get List of items

        $employees = Employee::get_full_name_and_id();

        return view('items.issued.edit',compact('itemIssued','employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemIssuedRequest $request, ItemIssued $itemIssued)
    {
        $this->authorize('update',$itemIssued);

        //Check if Quantity has been updated
        if($request->quantity != $request->old_quantity) { //Check if the Quantity Updated

            //Check if quantity requested is smaller than the remaining quantity
            if($this->check_quantity_smaller_than_remaining_quantity($request->item_id,$request->quantity,$request->old_quantity) == true){

                $itemIssued->update($request->all()); //Update item issued table

                $this->reduce_item_quantity_on_updating($request->item_id,$request->quantity,$request->old_quantity);

                return redirect()->route('itemIssued.index')->with('success','Issued Item has been Updated');
            }
            else {
                return back()->withInput($request->input())->with('error','Sorry the Quantity requested is greater than the remain quantity!');
            }

        }
        else {
            $itemIssued->update($request->all());
            return redirect()->route('itemIssued.index')->with('success','Issued Item has been Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemIssued $itemIssued)
    {
        $this->authorize('delete',$itemIssued);

        $this->reduce_item_quantity_on_deleting($itemIssued->item_id,$itemIssued->quantity);

        $itemIssued->delete();

        return redirect()->route('itemIssued.index')->with('success','Issued Item has been deleted');

    }

    /*
    * Reduce number of stock on item when issued
    */
    public function reduce_item_quantity_on_creating ($item_id,$quantity)
    {
        $item = $this->get_item_id($item_id);

        if($item->quantity >= $quantity) {   //Check if the Quantity requested is smallet then the quantity remain
            $item->decrement('quantity',$quantity);
            return true;
        }
        else {
            return false; //return nothing
        }
    }

    /*
     * Update the Item Quantity
     */
    public function reduce_item_quantity_on_updating ($item_id,$quantity,$old_quantity)
    {
        $item = $this->get_item_id($item_id);

        $item->increment('quantity',$old_quantity);

        $item->decrement('quantity',$quantity);

        return null; //return nothing
    }

    /*
     * Delete the Item Quantity
     */
    public function reduce_item_quantity_on_deleting ($item_id, $quantity)
    {
        $item = $this->get_item_id($item_id);

        $item->increment('quantity',$quantity);

        return;

    }

    /*
     * Check if the Quantity issued is greater than the item remain quantity
    */
    public function check_quantity_smaller_than_remaining_quantity ($item_id, $quantity, $old_quantity)
    {
        $item = $this->get_item_id($item_id);

        $item_quantity = $item->quantity + $old_quantity;

        if($item_quantity >= $quantity) {   //Check if the Quantity requested is smallet then the quantity remain
            return true;
        }
        else {
            return false; //return nothing
        }
    }

    /*
     * Get Item ID
     */
    public function get_item_id ($item)
    {
        $item = Item::where('id',$item)->first();

        return $item;
    }

}
