<?php

namespace Pxpm\BackpackFullCalendar\Traits;

use Pxpm\BackpackFullCalendar\Models\Calendar as DBCalendar;

trait HasCalendar {

    /**
    * The name to give to calendar. You can override this in your model by setting the name you would like.
    *
    * @var string
    */
    public $calendarName = 'Auto Calendar';

    /**
     * The field where we should pick ID to relate the calendar, by default it's 'id'.
     *
     * @var string
     */
    public $idForCalendar = 'id';


    public static function bootHasCalendar()  {

        static::created(function($item) {
            return $item->createCalendar();
        });

        static::deleted(function($item) {
            return $item->deleteCalendar();
        });
    }

    /**
     * Creates a new calendar on database for the entity.
     *
     * @return void
     */
    public function createCalendar() {
        DBCalendar::create([
            'name' => $this->calendarName,
            'calendar_entity_id' => $this->{$idForCalendar},
            'calendar_entity_namespace' => get_class($this),
        ]);
    }

    /**
     * Deletes the entity calendar from database.
     *
     * @return void
     */
    public function deleteCalendar() {
        DBCalendar::where([
            'calendar_entity_id' => $this->{$idForCalendar},
            'calendar_entity_namespace' => get_class($this),
        ])->first()->delete();
    }

    /**
     * Retrieves entity calendar from database
     *
     * @return void
     */
    public function getCalendar() {
        return DBCalendar::where([
            'calendar_entity_id' => $this->{$idForCalendar},
            'calendar_entity_namespace' => get_class($this),
        ])->first();
    }

    /**
     * Adds a buttom in the line stack to view entity calendar.
     *
     * @return void
     */
    public function addViewCalendarButtonOnLine() {
        
    }
}