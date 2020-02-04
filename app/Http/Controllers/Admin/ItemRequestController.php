<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequestRequest;
use App\ItemIssued;
use App\Item;
use Illuminate\Http\Request;

class ItemRequestController extends Controller
{
    /**
     * AdminController constructor.
     */
    function __construct()
    {
        $this->middleware(['auth:admin']);
    }


    public function index(ItemIssued $itemIssued)
    {
        $itemIssueds = $itemIssued->where('employee_id',auth()->user()->employee->id)->orderBy('date_issued','desc')->with('employee','item')->get();

        return view('items.requests.index',compact('itemIssueds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ItemIssued $itemIssued)
    {
        $items = Item::quantity_greater_than_zero(); //Get List of items

        return view('items.requests.create',compact('items','itemIssued'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequestRequest $request, ItemIssued $itemIssued)
    {
        $request['status'] = 'O';

        $this->get_requests($request);

        //dd($request->all());

        $itemIssued = $itemIssued->create($request->all());

        return back()->with('success','Your Request Has Been Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Get Other Constants Request Data
     */
    public function get_requests($request)
    {
        $request['date_issued'] = date('Y-m-d');
        $request['quantity'] = 0;
        $request['employee_id'] = auth()->user()->employee->id;

        return $request;
    }
}
