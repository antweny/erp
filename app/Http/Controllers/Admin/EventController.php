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

        $events = $event->with('event_category','employee')->get();

        return view('events.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Event $event)
    {
        $this->authorize('create',$event);

        $eventCategories = EventCategory::get_name_and_id();
        $venues = Venue::get_name_and_id();
        $individuals = Individual::get_name_and_id();
        $organizations = Organization::get_name_and_id();
        $employees = Employee::get_full_name_and_id();


        return view('events.create',compact('event','eventCategories','venues','individuals','organizations','employees'));
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

        // assume it won't work
        $success = false;


        DB::beginTransaction();

        try {
            if ($event = $event->create($request->all())) {
                $event->organization()->attach($organizations);
                $event->individual()->attach($individuals);
                $success = true;
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
        if ($success) {
            DB::commit();
            return back()->with('success',' Event has been saved');
        } else {
            DB::rollback();
            return back()->with('error',' Something went wrong')->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $this->authorize('update',$event);

        $eventCategories = EventCategory::get_name_and_id();
        $venues = Venue::get_name_and_id();
        $individuals = Individual::get_name_and_id();
        $organizations = Organization::get_name_and_id();
        $employees = Employee::get_full_name_and_id();

        return view('events.edit',compact('event','eventCategories','venues','individuals','organizations','employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        $this->authorize('update',$event);

        $request['venue_id'] = $this->check_venue($request['venue']);
        $organizations = $request['organization_id'];
        $individuals = $request['individual_id'];

        // assume it won't work
        $success = false;


        DB::beginTransaction();

        try {
            if ($event->update($request->all())) {
                $event->organization()->sync($organizations);
                $event->individual()->sync($individuals);
                $success = true;
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
        if ($success) {
            DB::commit();
            return  redirect()->route('events.index')->with('success',' Event has been updated');
        } else {
            DB::rollback();
            return back()->with('error',' Something went wrong')->withInput($request->input());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete',$event);

        $event->delete();

        return back()->with('success','Event has been deleted');
    }



    /*
     * Get Venue ID
     */
    public function check_venue($request)
    {
        $name = new Venue();

        return $name->get_id($request);
    }

    public function organization($request){

    }
}
