<?php

namespace App;


class ItemRequest extends BaseModel
{
    /**
     * The model table.
     */
    //protected $table = 'item_issued';


    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['date_issued','item_id','quantity','remarks','employee_id','required','status','desc'];


    /**
     * Log all activities performed on the model
     */

    protected static $logName = 'item_requests';


    /* ------------------
     *  Accessor  Functions
     * ------------------
     */
    public function getItemStatusAttribute()
    {
        switch ($this->status){

            case 'O' :
                return '<span class="status  bg-danger text-white">Open</span>';
                break;
            case 'C' :
                return '<span class="status  bg-success text-white ">Issued</span>';
                break;
            default:
                return NULL;
        }
    }
    public function getDateIssuedAttribute($value)
    {
        if (is_null($value)){
            return '';
        }
        else {
            return get_day_month_and_year($value);
        }
    }
    public function getCreatedAtAttribute($value)
    {
        if (is_null($value)){
            return '';
        }
        else {
            return get_day_month_and_year($value);
        }
    }


    /* ------------------------------------
     * Model Relationship with other models
     * -------------------------------------
     */

    //All received belongs to a particular item
    public function item()
    {
        return $this->belongsTo(Item::class)->withDefault();
    }

    //Items must be issued to staff
    public function employee()
    {
        return $this->belongsTo(Employee::class)->withDefault();
    }
}
