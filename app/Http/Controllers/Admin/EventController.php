<?php


namespace App\Http\Controllers\Admin;

use App\Employee;
use App\EventCategory;
use App\Http\Controllers\Controller;

use App\Event;
use App\Http\Requests\EventRequest;
use App\Individual;
use App\Organization;
use App\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        $this->authorize('read',$event);
        try {
            $events = $event->with('event_category','employee')->get();
            return view('events.index',compact('events'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Event $event)
    {
        $this->authorize('create',$event);
        try {
            return $this->populate(__FUNCTION__,$event);
        }
        catch (\Exception $e) {
           abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request, Event $event)
    {
        $this->authorize('create',$event);

        $request['venue_id'] = $this->check_venue($request['venue']);   //Get Venue ID
        $organizations = $request['organization_id'];  //Get array of organization as organisers
        $individuals = $request['individual_id']; //Get array of individuals as facilitator

        DB::beginTransaction();

        try {
            $event = $event->create($request->all());
            $event->organization()->attach($organizations);
            $event->individual()->attach($individuals);
            DB::commit();
            return back()->with('success',' Event has been saved');
        }
        catch (\Exception $e) {
            DB::rollback();
            return back()->with('error',' Something went wrong')->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('update',$this->model());
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
        $this->authorize('update',$this->model());

        $request['venue_id'] = $this->check_venue($request['venue']);
        $organizations = $request['organization_id'];
        $individuals = $request['individual_id'];

        DB::beginTransaction();

        try {
            $this->getID($id)->update($request->all());
            $this->getID($id)->organization()->sync($organizations);
            $this->getID($id)->individual()->sync($individuals);
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
    public function destroy(Event $event)
    {
        $this->authorize('delete',$event);
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
        $individuals = Individual::get_name_and_id();
        $organizations = Organization::get_name_and_id();
        $employees = Employee::get_full_name_and_id();
        $data = compact('event','eventCategories','venues','individuals','organizations','employees');
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
