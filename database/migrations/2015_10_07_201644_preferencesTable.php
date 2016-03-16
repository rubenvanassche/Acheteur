<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PreferencesTable extends Migration
{

    public function up()
    {
        Schema::create('preferences', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('content');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('preferences');
    }
}
