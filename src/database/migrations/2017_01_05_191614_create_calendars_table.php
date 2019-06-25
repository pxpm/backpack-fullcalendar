<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->integer('calendar_entity_id')->unsigned()->nullable();
            $table->string('calendar_entity_namespace')->nullable();
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
        Schema::drop('calendars');
    }
}
