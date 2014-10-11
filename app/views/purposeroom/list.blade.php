@extends('layouts.mobile')

@section('content')
<div data-role="page" class="purpose_list" data-url='{{ URL::to("customer/$customer_id/purposeroom/list") }}'>
    <div data-role="content">
     <h3 class="ui-bar ui-bar-a">意向房源</h3>

	 <a href='{{ URL::to("customer/$customer_id/purposeroom/add") }}' data-ajax="true" class="ui-btn ui-shadow ui-corner-all">新增</a>

	@foreach($purposeroomList as $purposeroom)
   <?php
    	$room=$purposeroom->room();//d($room);
    ?>
	 <ul class="item" data-role="listview" data-inset="true">
	 	 <li><a href='{{ URL::to("customer/$customer_id/purposeroom/$purposeroom->id/edit") }}' >{{$purposeroom->id}}</a></li>
    	<li>
		@if($room)
		房间:{{$room['project_name'].$room['building_name'].$room['buildingunit_name'].$room['room_name']}}
		@endif
		</li>
		<li>
    	<div class="ui-grid-a">
		    <div class="ui-block-a">面积:{{$room['buildingArea']}}</div>
		    <div class="ui-block-b">总价:{{$room['totalAmount']}}</div>
		</div>
		</li>
		<li>
    	<div class="ui-grid-a">
		    <div class="ui-block-a">意向级别:{{$purposeroom->level}}</div>
		    <div class="ui-block-b">考虑因素:{{$purposeroom->reason}}</div>
		</div>
		</li>

	 </ul>
	 @endforeach
	</div>
</div>
@stop
