<?php

namespace Pxpm\BackpackFullCalendar\Models;

use Pxpm\BackpackFullCalendar\Event;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Pxpm\BackpackFullCalendar\Models\CalendarEventType as EventType;

class CalendarEvent extends Model implements \Pxpm\BackpackFullCalendar\Event
{
    use CrudTrait;

     /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

    //protected $table = 'calendar_events';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
     protected $fillable = ['event_title','event_description','event_start','event_end','calendar_id','calendar_event_type_id'];
    // protected $hidden = [];
    protected $dates = ['event_start', 'event_end'];

    /*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/


    protected static function boot()
    {
        parent::boot();

        //static::addGlobalScope(new TenantQueryScope);

        static::creating(function ($model) {

            if ($model->event_end === null) {
                $model->event_end = $model->event_start;
            }
            if ($model->event_description === null) {
                $model->event_description = EventType::where('id', '=', $model->calendar_event_type_id)->first()->description;
            }



        });
    }
    /**
     * Get the event's id number
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->event_title;
    }
    /**
     * Get color from event type
     *
     * @return string
     */
    public function getColor() {

        return $this->EventType->default_event_type_color;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return (bool)$this->is_all_day;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->event_start;
    }

    /*public function getEventType() {
        return $this->EventType()->first();
    }*/

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->event_end;
    }
    public function getEventOptions()
    {
        return [
            'color' => $this->getColor()
            //etc
        ];
    }

    /*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/
    public function Calendar(){
        return $this->belongsTo('\Pxpm\BackpackFullCalendar\Models\Calendar');
    }
    public function EventType(){
        return $this->belongsTo('\Pxpm\BackpackFullCalendar\Models\CalendarEventType', 'calendar_event_type_id');
    }
    /*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/

    /*
	|--------------------------------------------------------------------------
	| ACCESORS
	|--------------------------------------------------------------------------
	*/

    /*
	|--------------------------------------------------------------------------
	| MUTATORS
	|--------------------------------------------------------------------------
	*/
}
