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
        'name', 'sort','item_unit_id','item_category_id'
    ];


    /**
     * Log all activities performed on the model
     */
    protected static $logFillable = true;
    protected static $logName = 'items';
    protected static $logOnlyDirty = true;


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
