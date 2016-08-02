<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//房源销售项目是否可见
class CreateProjectosh extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fc_projectosh', function($table)
		{
			$table->string('sellproject_id');//销售项目，来自eas的数据
			$table->boolean('onshow')->nullable();//设置是否可见

			$table->primary('sellproject_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('fc_projectosh');
	}

}
