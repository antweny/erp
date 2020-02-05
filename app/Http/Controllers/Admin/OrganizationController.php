<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\District;
use App\Http\Controllers\Controller;
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

        $organizations = $organization->latest()->with(['city','organization_category','district','ward'])->get();

        return  view('organizations.index',compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Organization $organization)
    {
        $this->authorize('create',$organization);

        $cities = City::get_name_and_id();
        $districts = District::get_name_and_id();
        $wards = Ward::get_name_and_id();
        $categories = OrganizationCategory::get_name_and_id();

        return  view('organizations.create',compact('organization','cities','districts','wards','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganizationRequest $request, Organization $organization)
    {
        $this->authorize('create',$organization);

        $org = $organization->create($request->all());

        return back()->with('success',' Organization has been saved');
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
    public function edit(Organization $organization)
    {
        $this->authorize('update',$organization);

        $cities = City::get_name_and_id();
        $districts = District::get_name_and_id();
        $wards = Ward::get_name_and_id();
        $categories = OrganizationCategory::get_name_and_id();

        return  view('organizations.edit',compact('organization','cities','districts','wards','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrganizationRequest $request, Organization $organization)
    {
        $this->authorize('update',$organization);

        $organization->update($request->all());

        return redirect()->route('organizations.index')->with('success',' Organization has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization)
    {
        $this->authorize('delete',$organization);

        $organization->delete();

        return back()->with('success',' Organization has been deleted');
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

}
