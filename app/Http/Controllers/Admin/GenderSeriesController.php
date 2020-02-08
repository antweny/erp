<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\Controller;

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

        // $individuals = Individual::select('full_name','id')->get();
        $individuals = Individual::get_name_and_id();
        $employees = Employee::get_full_name_and_id();

        return view('events.genderSeries.create',compact('genderSeries','individuals','employees'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(GenderSeriesRequest $request, GenderSeries $genderSeries)
    {
        $this->authorize('create',$genderSeries);

        $genderSeries->create($request->all());

        return back()->with('success',' Gender Series topic has been saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(GenderSeries $genderSeries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GenderSeries $genderSeries)
    {
        $this->authorize('update',$genderSeries);

        $individuals = Individual::get_name_and_id();
        $employees = Employee::get_full_name_and_id();

        return view('events.genderSeries.edit',compact('genderSeries','individuals','employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenderSeriesRequest $request, GenderSeries $genderSeries)
    {
        $this->authorize('update',$genderSeries);

        $genderSeries->update($request->all());

        return redirect()->route('genderSeries.index')->with('success','Gender Series topic has been updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GenderSeries $genderSeries)
    {
        $this->authorize('delete',$genderSeries);

        $genderSeries->delete();

        return back()->with('success','Gender Series topic has been deleted');
    }

}
