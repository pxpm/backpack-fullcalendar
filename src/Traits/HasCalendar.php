<?php

namespace Pxpm\BackpackFullCalendar\Traits;

use Pxpm\BackpackFullCalendar\Models\Calendar as DBCalendar;

trait HasCalendar {

    /**
     * Defines what field should be used to create the calendar relation, by default it's: 'id'
     * 
     * To override use protected $idForCalendar = 'your_id_field'
     *
     * @var integer
     */
    protected static $calendarIdField;

    /**
     * The name you wish to give to calendar. 
     * 
     * To override use protected $calendarName = 'name_for_calendar' in your model
     *
     * @var string
     */

    protected static $calendarNameForEntity;

    
    /**
     * This boots the trait and add the listeners to create calendars on the fly
     * Also it checks if user have overriden any of the properties for calendar.
     *
     * @return void
     */
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

    /**
     * Adds the buttom to view calendar on entity list.
     *
     * @return void
     */
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