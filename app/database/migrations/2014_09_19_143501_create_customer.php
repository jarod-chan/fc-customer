<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomer extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fc_customer', function($table)
		{
			$table->increments('id');//编号
			$table->string('name');//姓名
			$table->string('phone');//手机号
			$table->string('qq')->nullable();//qq号
			$table->string('email')->nullable();//邮箱
			$table->string('weixin')->nullable();//微信
			$table->string('from')->nullable();//来源
			$table->string('way')->nullable();//途径
			$table->string('state');//状态 purpose-意向客户 sign-签约客户 public-公共客户
			$table->integer('register_id');//登记人
			$table->dateTime('register_at');//创建时间
			$table->integer('counselor_id')->nullable();//销售顾问
			$table->dateTime('update_at')->nullable();//最后更新时间

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('fc_customer');
	}

}
