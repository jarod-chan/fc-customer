<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerRemark extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fc_customer',function ($table){
			if (Schema::hasColumn('fc_customer', 'remark'))
			{
				$table->dropColumn('remark');
			}
		});
		Schema::table('fc_customer',function ($table){
		 	$table->string('remark')->nullable();//备注，记录关键信息
		 });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fc_customer',function ($table){
			if (Schema::hasColumn('fc_customer', 'remark'))
			{
				$table->dropColumn('remark');
			}
		});
	}

}
