<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;

class Employee extends Authenticatable
{
    use Notifiable;
    use Uuids;
    use HasRoles;
    use LogsActivity;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['employee_no', 'first_name', 'middle_name',
        'last_name','dob','email','mobile','department_id','doj','password'];


    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Log all activities performed on the model
     */
    protected static $logName = 'employees';


    /* ------------------
   *  Mutator functions
   * ------------------*/
    public function setDojAttribute($value)
    {
        $this->attributes['doj'] = date_to_mysql($value);
    }
    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = date_to_mysql($value);
    }



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
