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



    /* ----------
     * ACCESSOR
     * ----------*/
    public function getPriorAttribute()
    {
        switch ($this->priority){
            case 'L':
                return '<span class="status  bg-warning">Low</span>';
                break;
            case 'M':
                return '<span class="status  bg-primary  text-white">Medium</span>';
                break;
            case 'H':
                return '<span class="status  bg-chocolate text-white">High</span>';
                break;
            case 'U':
                return '<span class="status  bg-danger text-white">Urgent</span>';
                break;
            default:
                return '';
                break;
        }
    }
    public function getStatAttribute()
    {
        switch ($this->status){
            case 'O':
                return '<span class="status  bg-danger text-white">Open</span>';
                break;
            case 'P':
                return '<span class="status  bg-success text-white">Closed</span>';
                break;
            default:
                return '';
                break;
        }
    }










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
