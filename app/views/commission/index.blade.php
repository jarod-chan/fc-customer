@extends('layouts.mobile')

@section('content')
<div data-role="page"  data-url='{{ URL::to("commission") }}'>
    <div data-role="content">
     <h3 class="ui-bar ui-bar-a">佣金结算</h3>

	@foreach($dealrecordList as $dealrecord)
	 <ul class="item" data-role="listview" data-inset="true">
	 	 <li><a href='{{ URL::to("commission/$dealrecord->id/deal") }}' >{{$dealrecord->id}}</a></li>
    	<li>
				房间:{{$dealrecord->room()["fname_l2"]}}
		</li>
		<li>
    	<div class="ui-grid-a">
		    <div class="ui-block-a">相关信息...</div>
		    <div class="ui-block-b"></div>
		</div>
		</li>

	 </ul>
	 @endforeach
	</div>
</div>
@stop
