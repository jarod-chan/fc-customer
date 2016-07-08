@extends('layouts.mobilescroll')

@section('head')
   	{{HTML::style('plug/scroll/scroll.css')}}
    {{HTML::script('plug/scroll/iScrollv4.2.5.js')}}
    {{HTML::script('views/commission.js')}}
@stop

@section('content')
<div data-role="page" class="commission_index" data-url='{{ URL::to("commission?state=$state&key=$key") }}'  >
	<script type="text/javascript">
    changeTitle('佣金结算');
    PG.setUrl('{{URL::to("commission/query")}}').setAll('{{$minId}}','{{$state}}','{{$key}}');
    </script>
    <div data-role="content" >

	{{ Form::open(array('url' => 'commission','data-ajax'=>'true','method'=>'get')) }}
	<div class="ui-body ui-body-a fy-query-scroll" >
	<div data-role="navbar">
	    <ul>
	    @foreach(Dealrecord::stateEnums() as $state_key=>$state_value)
			 <li><a id="state_{{$state_key}}" href="?state={{$state_key}}"  >{{$state_value}}</a></li>
	    @endforeach
	    </ul>
	</div>
	{{form::hidden('state',$state)}}
	<div class="fy-query">
	    <div class="c"  ><div>客户</div></div>
	    <div class="b" ><input type="text" name="key" id="key" value="{{$key}}"> <button class="fy-btn ui-btn  ui-corner-all"  >查询</button></div>
	</div>
	</div>
	{{ Form::close() }}

	<div id="wrapper" >
	<div id="scroller">
	<div id="item_div">
	@foreach($dealrecordList as $dealrecord)
	<?php
    	$room=$dealrecord->room();//d($room);
    ?>
	 <ul class="item" data-role="listview" data-inset="true">
	 	 <li><a href='{{ URL::to("commission/$dealrecord->id/deal?state=$state&key=$key") }}' >{{$dealrecord->id}}</a></li>

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

	 <ul id="pullUp"><li class="pullUpIcon"></li><li class="pullUpLabel">上拉加载更多数据</li></ul>
	 <div>&nbsp;</div>
	 
	 </div>
	</div>

	 

	</div>
</div>
@stop
