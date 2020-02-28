<?php

namespace App\Http\Controllers;


use App\GenderSeries;
use App\Http\Requests\GenderSeriesRequest;
use Illuminate\Http\Request;

class GenderSeriesController extends Controller
{
    /**
     * Authorization constructor.
     */
    function __construct()
    {
        $this->middleware('auth:admin',['only'=> ['index','store','create','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $genders = GenderSeries::with('individual','employee')->get();
            return view('events.genderSeries.index',compact('genders'));
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
        try{
            $genderSeries = new GenderSeries();
            return view('events.genderSeries.create',compact('genderSeries'));
        }
        catch (\Exception $e){
            return $this->errorReturn();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenderSeriesRequest $request)
    {
        $this->can_create($this->model());
        try {
            GenderSeries::create($request->all());
            return back()->with('success',' Gender Series topic has been saved');
        }
        catch (\Exception $e) {
            return back()->with('error','This user already attended this event')->withInput($request->input());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->can_update($this->model());
        try{
            $genderSeries = $this->getID($id);
            return view('events.genderSeries.edit',compact('genderSeries'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenderSeriesRequest $request,$id)
    {
        $this->can_update($this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('genderSeries.index')->with('success','Gender Series topic has been updated');
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
            return back()->with('success','Gender Series topic has been deleted');
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
        $data = GenderSeries::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return GenderSeries::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('genderSeries.index')->with('error','something went wrong');
    }

}
