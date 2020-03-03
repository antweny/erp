<?php

namespace App;




class Item extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'sort','item_unit_id','item_category_id','quantity','min_quantity'
    ];


    /**
     * Log all activities performed on the model
     */
    protected static $logName = 'items';


    /*
     * Mutator Functions
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
    }


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
            return '<span class="status text-white bg-danger">Out of Stock</span>';
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


    /*
     * Get Item Name and ID
     */
    static function get_name_and_id()
    {
        $items = Item::select('id','name')->get();

        return $items;
    }

    /*
     * Get Item with Quantity greater than 0
     */
    static function quantity_greater_than_zero()
    {
        $items = Item::select('id','name')->where('quantity','>',0)->orderBy('name','asc')->get();

        return $items;
    }
}
