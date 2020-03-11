<?php


namespace App\Http\Controllers;

use App\EventCategory;

use App\Event;
use App\Http\Requests\EventRequest;
use App\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $events =Event::with('event_category','employee')->get();
            return view('events.index',compact('events'));
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
            $event = new Event();
            return $this->populate(__FUNCTION__,$event);
        }
        catch (\Exception $e) {
           abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $this->can_create($this->model());

        $request['venue_id'] = $this->check_venue($request['venue']);   //Get Venue ID

        DB::beginTransaction();
        try {
            $event = Event::create($request->all());

            $event->organization()->attach($request['organization_id']);

            $event->individual()->attach($request['individual_id']);
            DB::commit();
            return back()->with('success',' Event has been saved');
        }
        catch (\Exception $e) {
            DB::rollback();
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
            $event = $this->getID($id);
            return $this->populate(__FUNCTION__,$event);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, $id)
    {
        $this->can_update($this->model());
        $request['venue_id'] = $this->check_venue($request['venue']);
        DB::beginTransaction();
        try {
            $this->getID($id)->update($request->all());
            $this->getID($id)->organization()->sync($request['organization_id']);
            $this->getID($id)->individual()->sync($request['individual_id']);
            DB::commit();
            return  redirect()->route('events.index')->with('success',' Event has been updated');
        }
        catch (\Exception $e) {
            DB::rollback();
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
            return back()->with('success','Event has been deleted');
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /*
     * Get Venue ID
     */
    public function check_venue($request)
    {
        $name = new Venue();
        return $name->get_id($request);
    }

    /*
    * Populate dropdowns values from different tables and return to forms
    */
    public function populate($function_name, $event) {
        $eventCategories = EventCategory::get_name_and_id();
        $venues = Venue::get_name_and_id();
        $data = compact('event','eventCategories','venues');
        return view('events.' .$function_name , $data);
    }

    /*
     * Get requested record ID
     */
    public function getID($id)
    {
        $data = Event::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Event::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('events.index')->with('error','something went wrong');
    }
}
