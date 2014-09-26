@extends('layouts.mobile')

@section('content')
<div data-role="page"  data-url='{{ URL::to("customer/$customer_id/dealrecord/list") }}'>
    <div data-role="content">
     <h3 class="ui-bar ui-bar-a">成交记录</h3>

	 <a href='{{ URL::to("customer/$customer_id/dealrecord/add") }}' data-ajax="true" class="ui-btn ui-shadow ui-corner-all">新增</a>

	@foreach($dealrecordList as $dealrecord)
	 <ul class="item" data-role="listview" data-inset="true">
	 	 <li><a href='{{ URL::to("customer/$customer_id/dealrecord/$dealrecord->id/edit") }}' >{{$dealrecord->id}}</a></li>
    	<li>
			房间信息
		</li>
		<li>
    	<div class="ui-grid-a">
		    <div class="ui-block-a">xxx</div>
		    <div class="ui-block-b"></div>
		</div>
		</li>

	 </ul>
	 @endforeach
	</div>
</div>
@stop
