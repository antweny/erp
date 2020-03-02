<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Imports\OrganizationImport;
use App\Http\Requests\OrganizationRequest;
use App\Organization;
use App\OrganizationCategory;
use Maatwebsite\Excel\Facades\Excel;

class OrganizationController extends Controller
{
    /**
     * Authorization constructor.
     */
    function __construct()
    {
        $this->middleware('auth:admin',['only'=> ['index','store','create','edit','update','destroy','import']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $organizations = Organization::latest()->with(['city','organization_category','district','ward'])->get();
            return  view('organizations.index',compact('organizations'));
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
            $organization = new Organization();
            return $this->populate(__FUNCTION__, $organization);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganizationRequest $request)
    {
        $this->can_create($this->model());
        try {
            $org = Organization::create($request->all());
            return back()->with('success',' Organization has been saved');
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
        $this->can_update($this->model());
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
        $this->can_delete($this->model());
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
        Excel::import(new OrganizationImport(), request()->file('imported_file'));
        return back()->with('success','Organization imported successfully!');
    }

    /*
     * Populate dropdowns values from different tables and return to forms
     */
    public function populate($function_name, $organization) {
        $categories = OrganizationCategory::get_name_and_id();
        $data = compact('organization','categories');
        return view('organizations.'.$function_name , $data);
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
