<?php

namespace Pxpm\BackpackFullCalendar\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class CalendarEventType extends Model
{
    use CrudTrait;

    protected static function boot()
    {
        parent::boot();

    }
     /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

    protected $table = 'calendar_event_types';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
     protected $fillable = ['name','description','default_event_type_color','refers_to'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/
    public function printEventColor() {
        return '<div style="width:100%;height:100%;background:'.$this->default_event_type_color.'">&nbsp</div>';
    }
    /*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/
    public function CalendarEvents() {
        return $this->hasMany('\Pxpm\BackpackFullCalendar\Models\CalendarEvent');
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
