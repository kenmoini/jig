<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('workshop_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->string('asset_type'); //eg, cookie, credentials, link
            $table->string('name'); // eg, GitLab Server, Workshop Domain Cookie
            $table->string('slug'); // eg, gitlab-server, workshop-domain-cookie
            $table->longText('asset_data'); 
            /* eg, 
              { 
                ['key' => 'domain', 'value' => 'fiercesw.network', 'path' => '/workshops/secure-software-factory/', 'expiration' => 7],
                ['title' => 'GitLab Server', 'url' => 'https://gitlab.fiercesw.network/', 'username' => ', 'password' => $SEAT_DEFAULT_PASSWORD],
                ['title' => 'Ansible Tower GUI', 'url' => 'https://ansible-tower.[[seat_number]].[[workshop_id]].[[domain]]', ], // Replace cookie vars on front-end
                ['title' => 'Workshop Slides', 'url' => 'https://slides.redhat.com/#1'],
                ...
              }
            */
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('assets');
    }
}
