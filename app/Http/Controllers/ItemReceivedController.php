<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemReceivedRequest;
use App\ItemReceived;
use App\Item;
use App\ItemUnit;
use Illuminate\Support\Facades\DB;

class ItemReceivedController extends Controller
{
    /**
     * Auth constructor.
     */
    function __construct()
    {
        $this->middleware('auth:admin',['only'=> ['index','create','store','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $itemReceiveds = ItemReceived::with('item.item_unit')->latest()->get();
            return view('store.itemReceived.index',compact('itemReceiveds'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->can_create($this->model());
        try {
            $itemReceived = new ItemReceived();
            return view('store.itemReceived.create',compact('itemReceived'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemReceivedRequest $request)
    {
        $this->can_create($this->model());
        DB::beginTransaction();
        try {
            $this->multiply_quantity_and_unit_rate($request); //Multiply Quantity and Unite Rate to get total amount of the items received
            ItemReceived::create($request->all());
            $this->increment_item_quantity($request);//Increment the Item Quantity
            DB::commit();
            return back()->with('success','Item has been received');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error',' Something went wrong')->withInput($request->input());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->can_update($this->model());
        try{
            $itemReceived = $this->getID($id);
            return view('store.itemReceived.edit',compact('itemReceived'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemReceivedRequest $request,$id)
    {
        $this->can_update($this->model());
        DB::beginTransaction();
        try {
            $this->multiply_quantity_and_unit_rate($request); //Multiply Quantity and Unite Rate to get total amount of the items received
            $itemReceived = $this->getID($id); //Get delatis of updating item received
            //Check if user update the item received quqntity
            if($request->quantity != $itemReceived->quantity)
            {
                $this->update_item_quantity($request,$itemReceived->quantity);
            }
            $itemReceived->update($request->all());
            DB::commit();
            return redirect()->route('itemReceived.index')->with('success','Received Item has been Updated');
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

        $this->can_delete($this->model());
        try {
            $itemReceived = $this->getID($id);
            //Before Delete check the item recived quantity is less than the remain item quantity
            $this->decrement_item_quantity($itemReceived->item_id,$itemReceived->quantity);
            $itemReceived->delete();
            DB::commit();
            return redirect()->route('itemReceived.index')->with('success','Received Item has been deleted');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return $this->errorReturn();
        }
    }

    /*
     * Multiply quantity and unit rate
     */
    public function multiply_quantity_and_unit_rate ($request)
    {
        $request['amount'] = multiply_two_numbers($request['quantity'],$request['unit_rate']);
        return $request;
    }

    /*
     * Increment Item Quantity Number
     */
    public function increment_item_quantity ($request)
    {
        $item = $this->get_item_id($request['item_id']);   //Initialize the class
        return $item->increment('quantity',$request['quantity']);
    }

    /*
     * Update the Item Quantity
     */
    public function update_item_quantity($request,$old)
    {
        $item = $this->get_item_id($request['item_id']);
        $item->decrement('quantity',$old);
        return $item->increment('quantity',$request['quantity']);
    }

    /*
     * Delete the Item Quantity
     */
    public function decrement_item_quantity ($id, $quantity)
    {
        $item = $this->get_item_id($id);
        return $item->decrement('quantity',$quantity);
    }

    /*
     * Get selected dropdown item ID
     */
    public function get_item_id ($id)
    {
        return Item::findOrFail($id);
    }

    /*
     * Get requested record ID
     */
    public function getID($id)
    {
        $data = ItemReceived::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controller model class
     */
    public function model ()
    {
        return ItemReceived::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('itemReceived.index')->with('error','something went wrong');
    }

}
