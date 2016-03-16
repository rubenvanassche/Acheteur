<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('event_id');
			$table->string('name');
			$table->string('email');
			$table->text('comments');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}