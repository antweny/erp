<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;


class BaseModel extends Model
{
    use Uuids;
    use LogsActivity;

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'id' => 'string'
    ];

    /**
     * Log all activities performed on the model
     */
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;


    /* ------------------
   *  Mutator functions
   * ------------------*/
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = date_to_mysql($value);
    }
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = date_to_mysql($value);
    }
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = date_to_mysql($value);
    }


     /* ------------------
      *  Mutator functions
      * ------------------*/
     public function getEndDateAttribute($value)
     {
         if(is_null($value)) {
             return '';
         }
         else {
             return get_day_month_and_year($value);
         }
     }
    public function getStartDateAttribute($value)
    {
        if(is_null($value)) {
            return '';
        }
        else {
            return $value;
        }
    }

    /* -------------------
     *   Other Functions
     * -------------------*/

    /*
     * Get record id
     */
    public function get_id($data)
    {
        if ($data != null) {
            $model = $this->firstOrCreate(['name'=>$data]);
            return $model->id;
        }
        return null;
    }

    /*
     * Get Name and ID
     */
   static function getNameID()
    {
        $data = self::select('id','name')->get();
        return $data;
    }

}
