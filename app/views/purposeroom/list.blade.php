@extends('layouts.mobile')

@section('content')
<div data-role="page" class="purpose_list" data-url='{{ URL::to("customer/$customer_id/purposeroom/list") }}'>
    <div data-role="content">
     <script type="text/javascript">changeTitle('意向房源')</script>

	  <p><button class="fy-btn ui-btn  ui-shadow  ui-corner-all" onclick="changePage('{{ URL::to("customer/$customer_id/purposeroom/add") }}')">新增</button></p>

	@foreach($purposeroomList as $purposeroom)
    <?php
    	$room=$purposeroom->room();//d($room);
    ?>
	 <ul class="item" data-role="listview" data-inset="true">
	 	 <li><a href='{{ URL::to("customer/$customer_id/purposeroom/$purposeroom->id/edit") }}' >{{$purposeroom->id}}</a></li>

		@if($room)
		<li>
		房间:{{$room['project_name'].$room['building_name'].$room['buildingunit_name'].$room['room_name']}}
		</li>
		@endif

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
