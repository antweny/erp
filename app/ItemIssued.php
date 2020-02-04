<?php

namespace App;

class ItemIssued extends BaseModel
{

    /**
     * The model table.
     */
    protected $table = 'item_issued';


    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'date_issued','item_id','desc', 'unit_rate','quantity','amount','remarks','employee_id','required','status'
    ];

    /**
     * Log all activities performed on the model
     */

    protected static $logName = 'item_issued';




    /* ------------------
     *  Accessor  Functions
     * ------------------
     */
    public function getItemStatusAttribute()
    {
      switch ($this->status){

          case 'O' :
              return '<span class="status  bg-danger">Request</span>';
              break;
          case 'R' :
              return '<span class="status  bg-primary ">Read</span>';
              break;
          case 'I':
              return '<span class="status  bg-success text-white">Issued</span>';
              break;
          default:
              return NULL;
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
