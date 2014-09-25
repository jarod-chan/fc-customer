<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInrecord extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fc_inrecord', function($table)
		{
			$table->increments('id');//id
			$table->integer('customer_id');//客户
			$table->integer('creater_id');//创建人
			$table->dateTime('create_at');//创建时间
			$table->integer('updater_id');//创建人
			$table->dateTime('update_at');//创建时间

			$table->string('type')->nullable();//	跟进方式
			$table->string('description')->nullable();//	跟进说明
			$table->string('result')->nullable();//	跟进成果
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('fc_inrecord');
	}

}
