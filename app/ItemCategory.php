<?php

namespace App;


class ItemCategory extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'desc', 'sort',
    ];


    /**
     * Log all activities performed on the model
     */
    protected static $logName = 'item_categories';




    /* ------------------------------------
     * Model Relationship with other models
     * -------------------------------------
     */

    //All items belong to a particular item category
    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
