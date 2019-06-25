<?php

//use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarEventsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_events', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('event_title', 255);
            $table->string('event_description', 5000);
            $table->datetime('event_start');
            $table->datetime('event_end')->nullable();
            $table->string('event_color')->nullable();
            $table->boolean('is_all_day')->default(1);
            $table->boolean('allow_override')->default(0);
            $table->integer('calendar_id')->unsigned();
            $table->integer('calendar_event_type_id')->unsigned();
            $table->boolean('is_recurring')->default(false);
            $table->string('recurring_time_frame')->nullable(); //week, day, month, year, hour, minute
            $table->string('recurring_frequency')->nullable(); //every, 
            $table->string('extras')->nullable();


            $table->timestamps();
        });

        Schema::create('calendar_event_types', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 255);
            $table->string('description', 5000);
            $table->string('refers_to')->nullable();
            $table->string('default_event_type_color')->nullable();
            $table->string('extras')->nullable();
            $table->timestamps();


        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('calendar_events');
        Schema::drop('calendar_event_types');
    }
}
