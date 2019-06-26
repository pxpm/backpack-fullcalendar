<?php

namespace Pxpm\BackpackFullCalendar\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Calendar extends Model
{
    use CrudTrait;

    protected static function boot()
    {
		parent::boot();
		
		static::deleted(function($calendar) {
			$calendar->events()->delete();
		});

    }
     /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

    protected $table = 'calendars';
    protected $primaryKey = 'id';
     public $timestamps = true;
    // protected $guarded = ['id'];
    protected $fillable = ['name'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/


    /*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/
    public function events(){
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
