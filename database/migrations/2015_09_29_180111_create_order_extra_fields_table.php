<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderExtraFieldsTable extends Migration {

	public function up()
	{
		Schema::create('order_extra_fields', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('event_id');
			$table->string('type');
			$table->string('rules');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('order_extra_fields');
	}
}