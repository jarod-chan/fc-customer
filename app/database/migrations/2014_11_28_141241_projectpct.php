<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Projectpct extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fc_projectpct', function($table)
		{
			$table->string('sellproject_id');//销售项目，来自eas的数据
			$table->decimal('percent',15,10)->nullable();//比例

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
		Schema::dropIfExists('fc_projectpct');
	}

}
