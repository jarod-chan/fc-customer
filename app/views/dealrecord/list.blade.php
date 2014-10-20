@extends('layouts.mobile')

@section('content')
<div data-role="page"  data-url='{{ URL::to("customer/$customer_id/dealrecord/list") }}'>
    <div data-role="content">
     <h3 class="ui-bar ui-bar-a">成交记录</h3>

	  <p><button class="fy-btn ui-btn  ui-shadow  ui-corner-all" onclick="changePage('{{ URL::to("customer/$customer_id/dealrecord/add") }}')">新增</button></p>

	@foreach($dealrecordList as $dealrecord)
	<?php
    	$room=$dealrecord->room();//d($room);
    ?>
	 <ul class="item" data-role="listview" data-inset="true">
	 	 <li><a href='{{ URL::to("customer/$customer_id/dealrecord/$dealrecord->id/edit") }}' >{{$dealrecord->id}}</a></li>

    	@if($room)
		<li>
		房间:{{$room['project_name'].$room['building_name'].H::nullStr($room,'buildunit_name').$room['roomName']}}
		</li>
		@endif

		<li>
		<div class="ui-grid-a">
		    <div class="ui-block-a">客户:{{$room['customer']}}</div>
		    <div class="ui-block-b">状态:{{$room['purchaseState']}}</div>
		</div>
		</li>
		<li>
		<div class="ui-grid-a">
		    <div class="ui-block-a">总价:{{$room['contractTotalAmount']}}</div>
		    <div class="ui-block-b">未付:{{$room['totalUnRevAmount']}}</div>
		</div>
		</li>
		<li data-role="list-divider">收款明细</li>
		@foreach($room['payList'] as $item)
		<li>
		<div class="ui-grid-b">
		    <div class="ui-block-a">{{$item['moneyDefine']}}</div>
		    <div class="ui-block-b">{{$item['revAmount']}}</div>
		    <div class="ui-block-c">{{H::nullStr($item,'revDate')}}</div>
		</div>
		</li>
		@endforeach
	 </ul>
	 @endforeach
	</div>
</div>
@stop
