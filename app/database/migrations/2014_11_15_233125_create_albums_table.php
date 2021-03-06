<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('albums', function($table) {
		
		# Increments method will make a Primary, Auto-Incrementing field.
        # Most tables start off this way
        $table->increments('id');
		
		# Important! FK has to be unsigned because the PK it will reference is auto-incrementing
		$table->integer('group_id')->unsigned(); 
						
		
        # This generates two columns: `created_at` and `updated_at` to
        # keep track of changes to a row
        $table->timestamps();
				
        $table->integer('albumNo');
		$table->string('albumName');
		$table->string('Genre');
		$table->string('Release Date');
		
		#Define foreign keys...
		#$table->foreign('group_id')->references('id')->on('groups'); 
			
	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('albums');
	}

}