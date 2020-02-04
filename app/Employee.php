<?php

namespace App;

class Employee extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'employee_no', 'first_name', 'middle_name','last_name','dob','email','mobile','department_id','admin_id','hire_date'
    ];


    /**
     * Log all activities performed on the model
     */
    protected static $logName = 'employees';




    /* ------------------
     *  Accessor  Functions
     * ------------------
     */
    public function getFullNameAttribute()
    {
        $full_name = $this->first_name.' '.$this->last_name;

        return $full_name;
    }


    /* ------------------------------------
     * Model Relationship with other models
     * -------------------------------------*/
    //Eveny Employee belong to a particula department
    public function department ()
    {
        return $this->belongsTo(Department::class)->withDefault();
    }


    /*
     * Get First Name, Middle Name, Last Name and ID
     */
    static function get_full_name_and_id()
    {
        $employee = Employee::select('id','first_name','middle_name','last_name')->get();

        return $employee;
    }




    /* ------------------------------------
     * Model Relationship with other models
     * -------------------------------------*/
    //Employee has one login credentials
    public function admin()
    {
        return $this->belongsTo(Admin::class)->withDefault();
    }

}
