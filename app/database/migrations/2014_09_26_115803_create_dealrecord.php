<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealrecord extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fc_dealrecord', function($table)
		{
			$table->increments('id');//id
			$table->integer('customer_id');//客户
			$table->integer('creater_id');//创建人
			$table->dateTime('create_at');//创建时间
			$table->integer('updater_id');//创建人
			$table->dateTime('update_at');//创建时间

			$table->string('room_id');//房间
			$table->string('state')->nullable();//状态 no未结算 do结算中 done已结算

			$table->decimal('percent',15,10)->nullable();//比例
			$table->decimal('commission',15,5)->nullable();//佣金
			$table->decimal('inamt',15,5)->nullable();//已结算金额
			$table->decimal('leftamt',15,5)->nullable();//已结算金额
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
			Schema::dropIfExists('fc_dealrecord');
	}

}
