<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('workshop_id')->unsigned();
            $table->bigInteger('user_id')->unsigned(); //Who created the event?

            $table->string('event_title');
            $table->text('description')->nullable();
            $table->text('private_notes')->nullable();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->string('event_id'); // could be unique, but better to have the system intelligently test EIDs based on timeframes to have recurring IDs
            $table->integer('seat_count')->default('50');
            $table->longText('effective_asset_data');
            // effective_asset_data - On creation of event, compile the assets of the associated workshop into an array and store here.
            //This is to track revisions and to allow additional/overrides on the assets on an per-event basis
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('workshop_id')->references('id')->on('workshops');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
