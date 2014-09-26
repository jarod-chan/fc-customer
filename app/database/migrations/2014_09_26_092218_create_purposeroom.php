<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurposeroom extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fc_purposeroom', function($table)
		{
			$table->increments('id');//id
			$table->integer('customer_id');//客户
			$table->integer('creater_id');//创建人
			$table->dateTime('create_at');//创建时间
			$table->integer('updater_id');//创建人
			$table->dateTime('update_at');//创建时间

			$table->string('room_id');//房间
			$table->string('level')->nullable();//	意向级别
			$table->string('reason')->nullable();//	考虑因素
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('fc_purposeroom');
	}

}
