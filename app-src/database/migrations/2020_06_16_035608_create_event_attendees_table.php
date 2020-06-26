<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_attendees', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->bigInteger('event_id')->unsigned(); // Prefill upon event creation
            $table->integer('seat_number'); // 0-50
            $table->tinyInteger('seat_state')->default('0'); // 0 = available, 1 = claimed, 2 = tainted
            $table->bigInteger('student_name_id')->unsigned()->nullable(); // Which named student
            $table->text('previous_student_name_ids')->nullable(); // An array of previous student_name.id's in case the seat is claimed, student is released, and is reset of its taint making it available to reclaim

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('student_name_id')->references('id')->on('student_names');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_attendees');
    }
}
