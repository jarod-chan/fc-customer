<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PurposeKpsj extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fc_purpose',function ($table){
			if (Schema::hasColumn('fc_purpose', 'kpsj'))
			{
				$table->dropColumn('kpsj');
			}
		});
		Schema::table('fc_purpose',function ($table){
		 	$table->date('kpsj')->nullable();
		 });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fc_purpose',function ($table){
			if (Schema::hasColumn('fc_purpose', 'kpsj'))
			{
				$table->dropColumn('kpsj');
			}
		});
	}

}
