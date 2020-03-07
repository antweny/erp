<?php

namespace App;


class Publication extends BaseModel
{
    /* -----------------------------------------
    * The attributes that are mass assignable.
    * -----------------------------------------*/
    protected $fillable = ['title','publication_category_id','author_id','publisher_id','year','class_number','shelf_id','genre_id','desc'];


    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'publications';




    /* ---------------------
    *  MODEL RELATIONSHIPS
    * ---------------------*/
    public function author()
    {
        return $this->belongsTo(Author::class)->withDefault();
    }

    //All Events have coordinator
    public function publisher()
    {
        return $this->belongsTo(Publisher::class)->withDefault();
    }

    //Every event belongs to a category
    public function publication_category()
    {
        return $this->belongsTo(PublicationCategory::class)->withDefault();
    }

    //Event can be Organized by many organization
    public function shelf()
    {
        return $this->belongsTo(Shelf::class)->withDefault();
    }

    //Event has many facilitators
    public function genre()
    {
        return $this->belongsTo(Genre::class)->withDefault();
    }




}
