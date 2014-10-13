@extends('layouts.mobile')

@section('content')
<div data-role="page"  data-url='{{ URL::to("commission") }}'>
    <div data-role="content">
     <h3 class="ui-bar ui-bar-a">佣金结算</h3>

	@foreach($dealrecordList as $dealrecord)
	<?php
    	$room=$dealrecord->room();//d($room);
    ?>
	 <ul class="item" data-role="listview" data-inset="true">
	 	 <li><a href='{{ URL::to("commission/$dealrecord->id/deal") }}' >{{$dealrecord->id}}</a></li>

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

	 </ul>
	 @endforeach
	</div>
</div>
@stop
