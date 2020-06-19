<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('activity_type'); // login, workshopInit (passing of proper workshop EID and data), pageLoad, click, surveySubmit, etc
            $table->bigInteger('actor_id')->unsigned(); // the student_name.id
            $table->string('actor_type'); // student, user, etc
            $table->text('activity_data'); // ['initiating_page' => 'inital/login/url.html'] / ['event_id' => 420] / ['pageURL' => 'loaded/page.html'], etc
            $table->text('user_agent');
            $table->text('actor_ip');
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
        Schema::dropIfExists('activity');
    }
}
