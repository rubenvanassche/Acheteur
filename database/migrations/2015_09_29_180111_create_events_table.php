<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	public function up()
	{
		Schema::create('events', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('slug');
			$table->string('password');
			$table->boolean('shifts');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('events');
	}
}