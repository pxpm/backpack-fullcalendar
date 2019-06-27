<?php

namespace Pxpm\BackpackFullCalendar\Commands;

use Illuminate\Console\Command;
use Pxpm\BackpackFullCalendar\Models\Calendar as DBCalendar;

class CreateEntitiesCalendar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backpack:calendar-creator {entity} {calendarName} {entityLinkId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates calendars for entities.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $entity = $this->argument('entity');
        $calendarName = $this->argument('calendarName');
        $linkEntityId = $this->argument('entityLinkId');
        if(class_exists($entity)) {
            $entityObjs = $entity::all();
            foreach($entityObjs as $obj) {
                DBCalendar::create([
                    'name' => $calendarName,
                    'calendar_entity_id' => $obj->{$linkEntityId},
                    'calendar_entity_namespace' => get_class($obj),
                ]);
            }
        }
    }
}
