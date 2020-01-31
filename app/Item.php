<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;


class Item extends BaseModel
{
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'sort','item_unit_id','item_category_id','quantity','min_quantity'
    ];


    /**
     * Log all activities performed on the model
     */
    protected static $logFillable = true;
    protected static $logName = 'items';
    protected static $logOnlyDirty = true;


    /* ------------------
     * Accessor  Functions
     * ------------------
     * */
    public function getStatusAttribute()
    {
        if ($this->quantity <= $this->min_quantity && $this->quantity != 0 )
        {
            return '<span class="status  bg-warning">Low</span>';
        }
        elseif ($this->quantity > $this->min_quantity) {
            return '<span class="status text-white bg-success">Good</span>';
        }
        elseif ($this->quantity == 0) {
            return '<span class="status text-white bg-danger">Order</span>';
        }
        else {
            return null;
        }
    }






    /* ------------------------------------
     * Model Relationship with other models
     * -------------------------------------
     */

    //All items belong to a particular item category
    public function item_category()
    {
        return $this->belongsTo(ItemCategory::class)->withDefault();
    }

    //All items belong to a particular item category
    public function item_unit()
    {
        return $this->belongsTo(ItemUnit::class)->withDefault();
    }

    //Item can received many times
    public function item_received()
    {
        return $this->hasMany(ItemReceived::class);
    }
}
