<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JobRelatedInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobrelatedinfo', function($table) {
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('firstName');
			$table->string('lastName');
			$table->string('county');
			$table->string('zipcode');
			$table->string('degree');
			$table->string('fieldOfStudy');
			$table->boolean('remember_token');
			$table->timestamps();
		}); 
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jobrelatedinfo');
	}

}
