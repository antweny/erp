<?php

namespace App;



class Ticket extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title', 'employee_id','ticket_category_id','priority','status','desc'
    ];


    /**
     * Log all activities performed on the model
     */
    protected static $logName = 'tickets';


    /*
     * Ticket belong to category
     */
    public function ticket_category()
    {
        return $this->belongsTo(TicketCategory::class)->withDefault();
    }


    /*
     * Ticket submitted by employee
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class)->withDefault();
    }
}
