<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;

class ItemIssued extends BaseModel
{
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'item_issued';


    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'date_issued','item_id','desc', 'unit_rate','quantity','amount','remarks'
    ];

    /**
     * Log all activities performed on the model
     */
    protected static $logFillable = true;
    protected static $logName = 'item_issued';
    protected static $logOnlyDirty = true;



    /* ------------------
     * Mutator Functions
     * ------------------
     */





    /* ------------------------------------
     * Model Relationship with other models
     * -------------------------------------
     */

    //All received belongs to a particular item
    public function item()
    {
        return $this->belongsTo(Item::class)->withDefault();
    }





}
