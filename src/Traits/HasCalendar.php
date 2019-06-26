<?php

namespace Pxpm\BackpackFullCalendar\Traits;

use Pxpm\BackpackFullCalendar\Models\Calendar as DBCalendar;

trait HasCalendar {

    protected static $calendarIdField;

    protected static $calendarNameForEntity;

    public static function bootHasCalendar()  {

        static::created(function($item) {
            return $item->createCalendar();
        });

        static::deleted(function($item) {
            return $item->deleteCalendar();
        });

        self::$calendarIdField = (new self)->getIdForCalendar();
        self::$calendarNameForEntity = (new self)->getCalendarName();


    }

   /* public function __construct() {
        $this->calendarIdField = $this->getIdForCalendar();
        $this->calendarNameForEntity = $this->getCalendarName();
    }*/

    /**
     * Creates a new calendar on database for the entity.
     *
     * @return void
     */
    public function createCalendar() {

       return DBCalendar::create([
            'name' => self::$calendarNameForEntity,
            'calendar_entity_id' => $this->{self::$calendarIdField},
            'calendar_entity_namespace' => get_class($this),
        ]);
    }

    /**
     * Deletes the entity calendar from database.
     *
     * @return void
     */
    public function deleteCalendar() {
        
       return DBCalendar::where([
            'calendar_entity_id' => $this->{self::$calendarIdField},
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
            'calendar_entity_id' => $this->{self::$calendarIdField},
            'calendar_entity_namespace' => get_class($this),
        ])->first();
    }

    /**
     * Adds a buttom in the line stack to view entity calendar.
     *
     * @return void
     */
    public function addViewCalendarButtonOnLine() {
        $this->crud->addButtonFromModelFunction('line', 'calendar_view_buttom', 'calendarViewButton', 'end');
    }

    public function calendarViewButton() {
        $calendar = $this->getCalendar();
        if(is_null($calendar)) {
            $calendar = $this->createCalendar();
        }
        return '<a class="btn btn-xs btn-default" href="'.route('view-entity-calendar',['id' => $calendar->id]).'" data-toggle="tooltip" title="View Calendar"><i class="fa fa-calendar"></i></a>';

    }

   public function getCalendarName() {
       return isset($this->calendarName) ? $this->calendarName : 'Auto Calendar';
   }

   public function getIdForCalendar() {
       return isset($this->idForCalendar) ? $this->idForCalendar : 'id';
   }
}