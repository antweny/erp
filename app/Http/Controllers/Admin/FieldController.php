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
        try {
            $fields = $field->latest()->with('sector')->get();
            $sectors = Sector::get_name_and_id();
            return view('organizations.fields.index',compact('fields','sectors'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FieldRequest $request, Field $field)
    {
        $this->authorize('create',$field);
        try {
            $field->create($request->only('name','desc','sector_id'));
            return back()->with('success',' Sector field has been saved');
        }
        catch (\Exception $e) {
            return back()->with('error',' Something went wrong')->withInput($request->input());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('update',$this->model());
        try{
            $field = $this->getID($id);
            $sectors = Sector::get_name_and_id();
            return view('organizations.fields.edit',compact('field','sectors'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FieldRequest $request, $id)
    {
        $this->authorize('update',$this->model());
        try {
            $this->getID($id)->update($request->only('name','desc','sector_id'));
            return redirect()->route('fields.index')->with('success','Sector field has been updated');
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
        $this->authorize('delete',$this->model());
        try {
            $this->getID($id)->delete();
            return back()->with('success','Sector field has been deleted');
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
        $data = Field::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Field::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('fields.index')->with('error','something went wrong');
    }

}
