<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketCategoryRequest;
use App\TicketCategory;

class TicketCategoryController extends Controller
{
    /**
     * Auth constructor.
     */
    function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $ticketCategories = TicketCategory::all();
            return view('supports.ticket.categories.index',compact('ticketCategories'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketCategoryRequest $request)
    {
        $this->can_create($this->model());
        try {
            TicketCategory::create($request->only('name','desc'));
            return back()->with('success','Ticket Category has been saved!');
        }
        catch (\Exception $e) {
            return back()->with('error',$e->getMessage())->withInput($request->input());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->can_update($this->model());
        try{
            $ticketCategory = $this->getID($id);
            return view('supports.ticket.categories.edit',compact('ticketCategory'));
        }
        catch (\Exception $e) {
            dd($e->getMessage());
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketCategoryRequest $request, $id)
    {
        $this->can_update($this->model());
        try {
            $this->getID($id)->update($request->only('name','desc'));
            return redirect()->route('ticketCategories.index')->with('success','ticket category has been updated!');
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->can_delete($this->model());
        try {
            $this->getID($id)->delete();
            return redirect()->route('ticketCategories.index')->with('success','ticket category has been deleted!');
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /*
     * Get requested record ID
     */
    public function getID($id)
    {
        $data = TicketCategory::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return TicketCategory::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('ticketCategories.index')->with('error','something went wrong');
    }
}
