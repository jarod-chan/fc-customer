<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventlog extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//记录存储过程的执行
		Schema::create('fc_eventlog', function($table)
		{
			$table->increments('id');
			$table->string('eventname');
			$table->datetime('create_at');//创建时间
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('fc_eventlog');
	}

}
