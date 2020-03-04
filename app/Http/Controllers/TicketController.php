<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Ticket;
use App\TicketCategory;
use Illuminate\Http\Request;

class TicketController extends Controller
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
        //$this->can_read($this->model());
        try {
            $tickets = Ticket::with('employee','ticket_category')->get();
            return view('supports.ticket.index',compact('tickets'));
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
        //$this->can_create($this->model());
        try {
            $ticket = new Ticket();
            return $this->populate(__FUNCTION__,$ticket);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        //$this->can_create($this->model());
        try {
            Ticket::create($request->all());
            return back()->with('success','Ticket has been submited!');
        }
        catch (\Exception $e) {
            return back()->with('error',' Something went wrong')->withInput($request->input());
        }
    }


    /*
     * Populate dropdowns values from different tables and return to forms
     */
    public function populate($function_name, $ticket) {
        $categories = TicketCategory::getNameID();
        $data = compact('ticket','categories');
        return view('supports.ticket.'.$function_name , $data);
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('tickets.index')->with('error','something went wrong');
    }

}
