<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectionsTable extends Migration {

	public function up()
	{
		Schema::create('sections', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('page_id');
			$table->text('content');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('sections');
	}
}