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
     * AdminController constructor.
     */
    function __construct()
    {
        $this->middleware(['auth:admin']);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(ItemReceived $itemReceived)
    {
        $this->authorize('read',$itemReceived);

        $itemReceiveds = $itemReceived->with('item')->get()->sortBy('date_received');

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

        $itemReceived->create($request->all());

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

        return redirect()->route('itemReceived.index')->with('success','Received Item has been Updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemReceived $itemReceived)
    {
        $itemReceived->delete();

        return redirect()->route('itemReceived.index')->with('success','Received Item has been deleted');
    }


}
