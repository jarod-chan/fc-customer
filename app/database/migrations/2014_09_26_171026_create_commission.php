<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommission extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fc_commission', function($table)
		{
			$table->increments('id');//id
			$table->integer('dealrecord_id');//成交记录id
			$table->decimal('percent',15,10)->nullable();//比例
			$table->decimal('commission',15,5)->nullable();//佣金
			$table->integer('counselor_id')->nullable();//销售顾问
			$table->date('comdate_at')->nullable();//创建时间
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('fc_commission');
	}

}
