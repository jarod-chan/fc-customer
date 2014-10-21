@extends('layouts.mobile')

@section('content')
<div data-role="page"  data-url='{{ URL::to("commission") }}'  >
    <div data-role="content">
     <script type="text/javascript">changeTitle('佣金结算');</script>

	@foreach($dealrecordList as $dealrecord)
	<?php
    	$room=$dealrecord->room();//d($dealrecord);
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
		<li>
		<div class="ui-grid-a">
		    <div class="ui-block-a">应结佣金:{{H::trimz($dealrecord->commission)}}</div>
		    <div class="ui-block-b">结算状态:{{$dealrecord->state()}}</div>
		</div>
		</li>
		<li>
		<div class="ui-grid-a">
		    <div class="ui-block-a">已结:{{H::trimz($dealrecord->inamt)}}</div>
		    <div class="ui-block-b">未结:{{H::trimz($dealrecord->leftamt)}}</div>
		</div>
		</li>

	 </ul>
	 @endforeach
	</div>
</div>
@stop
