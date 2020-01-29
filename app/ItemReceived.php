<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;

class ItemReceived extends BaseModel
{

    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'item_received';


    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'date_received','item_id','desc', 'unit_rate','quantity','amount','remarks'
    ];

    /**
     * Log all activities performed on the model
     */
    protected static $logFillable = true;
    protected static $logName = 'item_received';
    protected static $logOnlyDirty = true;



    /* ------------------
     * Mutator Functions
     * ------------------
     */

    //set the amount
    public function setQuantityAttribute($value)
    {
        $this->attributes['quantity'] = $value;
        $this->attributes['amount'] = $this->unite_rate * $value;
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
}
