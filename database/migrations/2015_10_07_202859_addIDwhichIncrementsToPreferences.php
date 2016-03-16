<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIDwhichIncrementsToPreferences extends Migration
{
    public function up()
    {
        Schema::table('preferences', function ($table) {
            $table->dropColumn('id');
        });

        Schema::table('preferences', function ($table) {
            $table->increments('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
