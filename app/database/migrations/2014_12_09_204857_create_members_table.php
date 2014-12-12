<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members', function($table) {
		
		# Increments method will make a Primary, Auto-Incrementing field.
        # Most tables start off this way
        $table->increments('id');

		# Important! FK has to be unsigned because the PK it will reference is auto-incrementing
		$table->integer('group_id')->unsigned(); 
		
        # This generates two columns: `created_at` and `updated_at` to
        # keep track of changes to a row
        $table->timestamps();
				
        $table->string('memberName');
		$table->integer('memberNo');
        $table->string('nationality');
				
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('members');
	}

}
