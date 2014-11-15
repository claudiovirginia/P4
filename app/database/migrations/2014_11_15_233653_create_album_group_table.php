<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('album_group', function($table) {
		# AI, PK
		# none needed
 
		# General data...
		$table->integer('album_id')->unsigned();
		$table->integer('group_id')->unsigned();
			
		# Define foreign keys...
		$table->foreign('album_id')->references('id')->on('albums');
		$table->foreign('group_id')->references('id')->on('groups');
	 });		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('album_group');
	}

}
