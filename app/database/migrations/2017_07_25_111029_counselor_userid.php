<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CounselorUserid extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fc_counselor',function ($table){
		 	$table->string('userid')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fc_counselor',function ($table){
			if (Schema::hasColumn('fc_counselor', 'userid'))
			{
				$table->dropColumn('userid');
			}
		});
	}

}
