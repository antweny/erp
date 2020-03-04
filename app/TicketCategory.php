<?php

namespace App;


class TicketCategory extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'desc'
    ];


    /**
     * Log all activities performed on the model
     */
    protected static $logName = 'ticket_categories';


    /* ------------------------------------
     * Model Relationship with other models
     * -------------------------------------
     */

    //All items belong to a particular item category

}
