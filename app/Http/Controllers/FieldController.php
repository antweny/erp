<?php


namespace App\Http\Controllers;

use App\Field;
use App\Http\Requests\FieldRequest;

class FieldController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $fields = Field::latest()->with('sector')->get();
            return view('organizations.fields.index',compact('fields'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FieldRequest $request)
    {
        $this->can_create($this->model());
        try {
            Field::create($request->only('name','desc','sector_id'));
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
        $this->can_update($this->model());
        try{
            $field = $this->getID($id);
            return view('organizations.fields.edit',compact('field'));
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
        $this->can_update($this->model());
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
