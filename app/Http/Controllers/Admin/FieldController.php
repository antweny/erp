<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Field;
use App\Http\Requests\FieldRequest;
use App\Sector;
use Illuminate\Http\Request;

class FieldController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Field $field)
    {
        $this->authorize('read',$field);

        $fields = $field->latest()->with('sector')->get();

        $sectors = Sector::get_name_and_id();

        return view('organizations.fields.index',compact('fields','sectors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FieldRequest $request, Field $field)
    {
        $this->authorize('create',$field);

        $field->create($request->only('name','desc','sector_id'));

        return back()->with('success',' Sector field has been saved');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Field $field, Sector $sector)
    {
        $this->authorize('update',$field);

        $sectors = Sector::get_name_and_id();

        return view('organizations.fields.edit',compact('field','sectors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FieldRequest $request, Field $field)
    {
        $this->authorize('update',$field);

        $field->update($request->only('name','desc','sector_id'));

        return redirect()->route('fields.index')->with('success','Sector field has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Field $field)
    {
        $this->authorize('delete',$field);

        $field->delete();

        return back()->with('success','Sector field has been deleted');
    }
}
