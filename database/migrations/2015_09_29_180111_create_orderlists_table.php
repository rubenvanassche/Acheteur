<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderlistsTable extends Migration {

	public function up()
	{
		Schema::create('orderlists', function(Blueprint $table) {
			$table->increments('id');
			$table->string('product_id');
			$table->integer('order_id');
			$table->integer('amount');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('orderlists');
	}
}