<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Controller;

use App\City;
use App\District;
use App\Http\Requests\ImportRequest;
use App\Imports\OrganizationImport;
use App\Http\Requests\OrganizationRequest;
use App\Organization;
use App\OrganizationCategory;
use App\Ward;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Organization $organization)
    {
        $this->authorize('read',$organization);
        try {
            $organizations = $organization->latest()->with(['city','organization_category','district','ward'])->get();
            return  view('organizations.index',compact('organizations'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Organization $organization)
    {
        $this->authorize('create',$organization);
        try {
            return $this->populate(__FUNCTION__, $organization);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganizationRequest $request, Organization $organization)
    {
        $this->authorize('create',$organization);
        try {
            $org = $organization->create($request->all());
            return back()->with('success',' Organization has been saved');
        }
        catch (\Exception $e) {
            return back()->with('error','This user already attended this event')->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
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
        $this->authorize('update',$this->model());
        try {
            $organization = $this->getID($id);
            return $this->populate(__FUNCTION__, $organization);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrganizationRequest $request, $id)
    {
        $this->authorize('update',$this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('organizations.index')->with('success',' Organization has been updated');
        }
        catch (\Exception $e) {
            return back()->with('error','This user already attended this event')->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('delete',$this->model());
        try {
            $this->getID($id)->delete();
            return back()->with('success',' Organization has been deleted');
        }
        catch (\Exception $e) {
            return  $this->errorReturn();
        }
    }

    /*
     *  Import Organization
     */
    public function import(ImportRequest $request, Organization $organization)
    {
        $this->authorize('import',$organization);

        if ($request->file('imported_file')) {
            Excel::import(new OrganizationImport(), request()->file('imported_file'));
            return back();
        }
    }

    /*
     * Populate dropdowns values from different tables and return to forms
     */
    public function populate($function_name, $organization) {
        $cities = City::get_name_and_id();
        $districts = District::get_name_and_id();
        $wards = Ward::get_name_and_id();
        $categories = OrganizationCategory::get_name_and_id();

        $data = compact('organization','cities','districts','wards','categories');
        return view('organizations.' .$function_name , $data);
    }

    /*
     * Get requested record ID
     */
    public function getID($id)
    {
        $data = Organization::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Organization::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('organizations.index')->with('error','something went wrong');
    }


}
