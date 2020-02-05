<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemReceivedRequest;
use App\ItemReceived;
use App\Item;
use App\ItemUnit;

class ItemReceivedController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(ItemReceived $itemReceived)
    {
        $this->authorize('read',$itemReceived);

        $itemReceiveds = $itemReceived->with('item')->get()->sortBy('date_received');

        $itemUits = ItemUnit::select('id','name')->get();

        $itemUits = ItemUnit::select('id','name')->get();

        return view('items.received.index',compact('itemReceiveds','itemUits'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(ItemReceived $itemReceived)
    {
        $this->authorize('create',$itemReceived);

        $items = Item::select('id','name')->get(); //Get List of items

        return view('items.received.create',compact('itemReceived','items'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemReceivedRequest $request, ItemReceived $itemReceived)
    {
        $this->authorize('create',$itemReceived);

        //Multiply Quantity and Unite Rate to get total amount of the items received
        $request['amount'] = multiply_two_numbers($request->quantity,$request->unit_rate);

        $itemReceived = $itemReceived->create($request->all());

        //Increment the Item Quantity
        $this->item_quantity($itemReceived->item_id, $itemReceived->quantity);

        return back()->with('success','Item has been received');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemReceived $itemReceived)
    {
        $this->authorize('update',$itemReceived);

        $items = Item::select('id','name')->get(); //Get List of items

        return view('items.received.edit',compact('itemReceived','items'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ItemReceivedRequest $request, ItemReceived $itemReceived)
    {
        $this->authorize('update',$itemReceived);

        //Multiply Quantity and Unite Rate to get total amount of the items received
        $request['amount'] = multiply_two_numbers($request->quantity,$request->unit_rate);

        $itemReceived->update($request->all());

        //Check if Item Quantity Updated
        if($request->quantity != $request->old_quantity)
        {
            $this->update_item_quantity($request->item_id,$request->quantity,$request->old_quantity);
        }

        return redirect()->route('itemReceived.index')->with('success','Received Item has been Updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemReceived $itemReceived)
    {
        if($this->check_before_delete_item_received ($itemReceived->item_id,$itemReceived->quantity) == false) {
            $itemReceived->delete();
            return redirect()->route('itemReceived.index')->with('success','Received Item has been deleted');
        }
        else {
            return redirect()->route('itemReceived.index')->with('error','Received Item can not be deleted');
        }

    }

    /*
     * Increment Item Quantity Number
     */
    public function item_quantity($item_id, $quantity)
    {
        $item = $this->get_item_id($item_id);   //Initialize the class

        $item->increment('quantity',$quantity);

        return null; //return nothing
    }

    /*
     * Update the Item Quantity
     */
    public function update_item_quantity($item_id,$quantity,$old_quantity)
    {
        $item = $this->get_item_id($item_id);

        $item->decrement('quantity',$old_quantity);

        $item->increment('quantity',$quantity);

        return null; //return nothing
    }

    /*
     * Delete the Item Quantity
     */
    public function check_before_delete_item_received ($item_id, $quantity)
    {
        $item = $this->get_item_id($item_id);

        if($item->quantity < $quantity )
        {
            return true;
        }
        else {
            $item->decrement('quantity',$quantity);

            return false;
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
