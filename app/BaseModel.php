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



    /* -------------------
     *   Other Functions
     * -------------------*/
    public function get_id($data)
    {
        if ($data != null) {
            $model = $this->firstOrCreate(['name'=>$data]);
            return $model->id;
        }
        return null;
    }

}
