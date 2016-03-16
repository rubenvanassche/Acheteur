<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductAvailabilityTable extends Migration {

	public function up()
	{
		Schema::create('product_availability', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id');
			$table->string('shift_id');
			$table->integer('available');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('product_availability');
	}
}