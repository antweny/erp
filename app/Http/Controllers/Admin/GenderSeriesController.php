<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\Admin\Controller;

use App\GenderSeries;
use App\Http\Requests\GenderSeriesRequest;
use App\Individual;
use Illuminate\Http\Request;

class GenderSeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GenderSeries $genderSeries)
    {
        $this->authorize('read',$genderSeries);

        $genders = $genderSeries->with('individual','employee')->get();

        return view('events.genderSeries.index',compact('genders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(GenderSeries $genderSeries)
    {
        $this->authorize('create',$genderSeries);

        return $this->populate(__FUNCTION__,$genderSeries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenderSeriesRequest $request, GenderSeries $genderSeries)
    {
        $this->authorize('create',$genderSeries);

        try {
            $genderSeries->create($request->all());
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
        $this->authorize('update',$this->model());
        try{
            $genderSeries = $this->getID($id);
            return $this->populate(__FUNCTION__,$genderSeries);
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
        $this->authorize('update',$this->model());
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
    public function destroy(GenderSeries $genderSeries)
    {
        $this->authorize('delete',$genderSeries);

        try {
            $this->getID($id)->delete();
            return back()->with('success','Gender Series topic has been deleted');
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /*
    * Populate dropdowns values from different tables and return to forms
    */
    public function populate($function_name, $genderSeries) {
        $individuals = Individual::get_name_and_id();
        $employees = Employee::get_full_name_and_id();

        $data = compact('genderSeries','individuals','employees');

        return view('events.genderSeries.' .$function_name , $data);
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
