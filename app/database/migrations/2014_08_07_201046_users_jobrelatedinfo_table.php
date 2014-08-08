<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersJobrelatedinfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_profile', function($table)
		{
	
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('firstName');
			$table->string('lastName');
			$table->string('zipcode');
			$table->string('degree');
			$table->string('fieldOfStudy');
			$table->string('currentJobTitle');
			$table->string('previousJobTitle');
			$table->timestamps();
		
		}); 
		
        Schema::create('users_skills', function($table)
		{

            $table->increments('id');
            $table->integer('user_profile_id')->unsigned();
            $table->foreign('user_profile_id')->references('id')->on('users_profile');
            $table->string('skill_1');
            $table->string('skill_2');
            $table->string('skill_3');
            $table->string('skill_4');
            $table->string('skill_5');
            $table->string('skill_6');
            $table->string('skill_7');
            $table->string('skill_8');
            $table->string('skill_9');
            $table->string('skill_10');		
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
		Schema::drop('users_profile');
		Schema::drop('users_skills');
	}

}
