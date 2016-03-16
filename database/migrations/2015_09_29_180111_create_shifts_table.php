<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShiftsTable extends Migration {

	public function up()
	{
		Schema::create('shifts', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('event_id');
			$table->timestamp('start');
			$table->timestamp('end');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('shifts');
	}
}