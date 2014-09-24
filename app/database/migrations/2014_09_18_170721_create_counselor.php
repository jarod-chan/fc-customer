<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounselor extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fc_counselor', function($table)
		{
			$table->increments('id');
			$table->string('name');//姓名
			$table->string('role');//角色 s-销售顾问 m-部门经理
			$table->string('openid')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('fc_counselor');
	}

}
