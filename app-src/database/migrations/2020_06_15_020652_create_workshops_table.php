<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned(); //Who created the event?

            $table->string('name'); //eg Ansible for Networking
            $table->string('slug'); //eg ansible-for-networking
            $table->string('curriculum_slug'); // ansible_networking
            $table->string('curriculum_endpoint'); // https://redhatgov.io/workshops/
            $table->decimal('typical_length_in_hours', 4, 2); //8.00
            $table->text('description')->nullable();

            $table->timestamps();
            $table->softDeletes();
            
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
        Schema::dropIfExists('workshops');
    }
}
