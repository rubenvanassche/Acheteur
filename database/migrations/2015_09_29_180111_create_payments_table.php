<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('order_id');
			$table->enum('type', array('cash', 'bank'));
			$table->float('amount');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('payments');
	}
}