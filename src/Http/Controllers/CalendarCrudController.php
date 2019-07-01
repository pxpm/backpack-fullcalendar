<?php

namespace Pxpm\BackpackFullCalendar\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use Pxpm\BackpackFullCalendar\Http\Requests\CalendarRequest as StoreRequest;
use Pxpm\BackpackFullCalendar\Http\Requests\CalendarRequest as UpdateRequest;
use Pxpm\BackpackFullCalendar\Models\Calendar as DBCalendar;

class CalendarCrudController extends CrudController
{

    public function setUp()
    {

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("Pxpm\BackpackFullCalendar\Models\Calendar");
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/calendar');
        $this->crud->setEntityNameStrings('calendar', 'calendars');

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
        */
        
        $this->crud->addField([
            'label' => 'Name',
            'type' => 'text',
            'name' => 'name'
        ]);

        $this->crud->addColumn('name');
        
    }

	public function showCalendar($id) {
        $calEvents = [];
        $calInfo = DBCalendar::where('id', '=', $id)->with('events.EventType')->first();
        if (!is_null($calInfo)) {
            $this->data['crud'] = $this->crud;
           // dd($calInfo);
            $listCalEvents = $calInfo['events'];
            foreach ($listCalEvents as $eventCal) {
                $calEvents[] = app('CalendarHelper')->event($eventCal->getTitle(), $eventCal->isAllDay(), $eventCal->getStart(), $eventCal->getEnd(), $eventCal->id, $eventCal->getEventOptions());
            }
            $this->data['calEventsFront'] = app('CalendarHelper')->addEvents($calEvents);
            return view('backpack-fullcalendar::viewCalendar', $this->data);
        }
    }

    
}
