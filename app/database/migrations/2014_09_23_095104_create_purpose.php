<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurpose extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fc_purpose', function($table)
		{
			$table->increments('id');//编号
			$table->integer('customer_id');//客户
			$table->integer('creater_id');//创建人
			$table->dateTime('create_at');//创建时间
			$table->integer('updater_id');//创建人
			$table->dateTime('update_at');//创建时间

			$table->string('khjb')->nullable();//	客户级别
			$table->string('yxqd')->nullable();//	意向强度
			$table->string('gfdj')->nullable();//	购房动机
			$table->string('zzlx')->nullable();//	住宅类型
			$table->string('hxlx')->nullable();//	户型类型
			$table->string('mj')->nullable();//	面积
			$table->string('dj')->nullable();//	单价
			$table->string('zj')->nullable();//	总价
			$table->string('dd')->nullable();//	地段
			$table->string('jzfg')->nullable();//	建筑风格
			$table->string('jzx')->nullable();//	精装修
			$table->string('yhld')->nullable();//	优惠力度
			$table->string('kpsj')->nullable();//	开盘时间
			$table->string('xqf')->nullable();//	学区房
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('fc_purpose');
	}

}
