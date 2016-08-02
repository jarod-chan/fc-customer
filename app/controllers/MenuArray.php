<?php
$menuArray = array(
		array('name'=>'新增客户','url'=>URL::to("menu/to?counselor_id=$counselor->id&to=customer/add")),
		array('name'=>'意向客户','url'=>URL::to("menu/to?counselor_id=$counselor->id&to=customer/purpose")),
		array('name'=>'签约客户','url'=>URL::to("menu/to?counselor_id=$counselor->id&to=customer/sign")),
		array('name'=>'公共客户','url'=>URL::to("menu/to?counselor_id=$counselor->id&to=customer/public")),
		array('name'=>'可售房源','url'=>URL::to("menu/to?counselor_id=$counselor->id&to=fangyuan/project")),
		array('name'=>'佣金结算','url'=>URL::to("menu/to?counselor_id=$counselor->id&to=commission"))
);