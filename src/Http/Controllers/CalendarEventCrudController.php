<?php

namespace Pxpm\BackpackFullCalendar\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use Pxpm\BackpackFullCalendar\Http\Requests\CalendarEventRequest as StoreRequest;
use Pxpm\BackpackFullCalendar\Http\Requests\CalendarEventRequest as UpdateRequest;

class CalendarEventCrudController extends CrudController
{

    public function setUp()
    {

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("Pxpm\BackpackFullCalendar\Models\CalendarEvent");
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/calendarevent');
        $this->crud->setEntityNameStrings('calendarevent', 'calendar_events');

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/

        //$this->crud->setFromDb();
        $this->crud->addFields([
            [
                'name' => 'event_title',
                'type' => 'text',
                'label' => 'Event Title'

            ],
            [
                'name' => 'event_description',
                'type' => 'text',
                'label' => 'Event Description'

            ],
            [
                'name' => 'event_start',
                'label' => trans('calendars.event_start_time_label'),
                //'attributes' => ['id' => 'datePickerCarJob','disabled' => 'disabled'],
                'type' => 'datetime_picker',
                // optional:
                'datetime_picker_options' => [
                    'format' => 'DD/MM/YYYY HH:mm',
                    'language' => 'pt'
                ]
            ],


            [   // Checkbox
                'name' => 'is_all_day',
                'attributes' => ['id' => 'IsAllDayEvent'],
                'label' => trans('calendar.is_all_day_label'),
                'type' => 'checkbox'
            ],
            [
                'name' => 'event_end',
                'label' => trans('calendars.event_end_time_label'),
                'attributes' => ['id' => 'endTimeEvent','disabled' => 'disabled'],
                'type' => 'datetime_picker',
                // optional:
                'datetime_picker_options' => [
                    'format' => 'DD/MM/YYYY HH:mm',
                    'language' => 'pt'

                ]
            ],
            [// Select2
                    'label' => trans('calendars.attach_to_calendar'),
                    'type' => 'select2',
                    'attributes' => ['id' => 'CalendarId'],
                    'name' => 'calendar_id', // the db column for the foreign key
                    'entity' => 'Calendar', // the method that defines the relationship in your Model
                    'attribute' => 'name', // foreign key attribute that is shown to user
                    'model' => "Pxpm\BackpackFullCalendar\Models\Calendar"
                    //'pivot' => true
            ],
            [  // Select2
                'label' => "Event Type",
                'type' => 'select2',
                'attributes' => ['id' => 'eventType'],
                'name' => 'calendar_event_type_id', // the db column for the foreign key
                'entity' => 'EventType', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "Pxpm\BackpackFullCalendar\Models\CalendarEventType"
                //'pivot' => true
            ],


        ]);

        $this->crud->addColumns([
            'event_title',
            'event_start',
            'event_end'
        ]);
    }

   /* public function create()
    {

        $this->data['crud'] = $this->crud;
        //$this->data['fields'] = $this->crud->getCreateFields();
        //dd($this->data);
        return view('fullcalendar.createCalendarEvent', $this->data);
    }*/


	public function store(StoreRequest $request)
	{
		// your additional operations before save here
        $redirect_location = parent::storeCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
	}

	public function update(UpdateRequest $request)
	{
		// your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
	}
}
