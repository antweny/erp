<?php

namespace App\Http\Controllers\Admin;

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
        //$this->authorize('read',$itemReceived);

        $itemIssueds = $itemIssued->orderBy('date_issued','desc')->get();

        //$itemUits = ItemUnit::select('id','name')->get();

        return view('items.issued.index',compact('itemIssueds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$this->authorize('create',$itemReceived);

        $items = Item::select('id','name')->where('quantity','>',0)->get(); //Get List of items

        return view('items.issued.create',compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemIssuedRequest $request, ItemIssued $itemIssued)
    {
        //$this->authorize('create',$itemIssued);

        $itemIssued = $itemIssued->create($request->all());

        //Increment the Item Quantity
        if ($this->reduce_item_quantity($itemIssued->item_id, $itemIssued->quantity) == true ) {

            return back()->with('success','Item has been issued')->withInput($request);

        }

        else {
            return back()->with('error','Sorry the Quantity requested is smaller than the quantity remain');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    /*
    * Reduce number of stock on item when issued
    */
    public function reduce_item_quantity($item_id,$quantity)
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
     * Get Item ID
     */
    public function get_item_id ($item)
    {
        $item = Item::where('id',$item)->first();

        return $item;
    }

}
