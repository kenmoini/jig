<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSSOColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->string('provider')->default('internal');
          $table->string('provider_id')->nullable();
          $table->string('password')->nullable()->change();
          $table->string('provider_avatar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn('provider');
          $table->dropColumn('provider_id');
          $table->dropColumn('provider_avatar');
        });
    }
}
