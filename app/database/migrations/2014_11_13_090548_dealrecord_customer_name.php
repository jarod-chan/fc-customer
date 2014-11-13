<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DealrecordCustomerName extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fc_dealrecord',function ($table){
		 	$table->string('customer_name')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fc_dealrecord',function ($table){
			if (Schema::hasColumn('fc_dealrecord', 'customer_name'))
			{
				$table->dropColumn('customer_name');
			}
		});
	}

}
