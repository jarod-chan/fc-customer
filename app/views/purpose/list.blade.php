@extends('layouts.mobile')

@section('content')
<div data-role="page" class="purpose_list" data-url='{{ URL::to("customer/$customer_id/purpose/list") }}'>
    <div data-role="content">
     <h3 class="ui-bar ui-bar-a">意向信息</h3>

	 <a href='{{ URL::to("customer/$customer_id/purpose/add") }}' data-ajax="true" class="ui-btn ui-shadow ui-corner-all">新增</a>

	@foreach($purposeList as $purpose)
	 <ul class="item" data-role="listview" data-inset="true">
	 	 <li><a href='{{ URL::to("customer/$customer_id/purpose/$purpose->id/edit") }}' >{{$purpose->id}}</a></li>
    	<li>
    	<div class="ui-grid-a">
		    <div class="ui-block-a">客户级别:{{$purpose->khjb}}</div>
		    <div class="ui-block-b">意向强度:{{$purpose->yxqd}}</div>
		</div>
		</li>
		<li>
    	<div class="ui-grid-a">
		    <div class="ui-block-a">购房动机:{{$purpose->gfdj}}</div>
		    <div class="ui-block-b">住宅类型:{{$purpose->zzlx}}</div>
		</div>
		</li>
		<li>
    	<div class="ui-grid-a">
		    <div class="ui-block-a">户型类型:{{$purpose->yhlx}}</div>
		    <div class="ui-block-b">面积:{{$purpose->mj}}</div>
		</div>
		</li>
		<li>
    	<div class="ui-grid-a">
		    <div class="ui-block-a">单价:{{$purpose->dj}}</div>
		    <div class="ui-block-b">总价:{{$purpose->zj}}</div>
		</div>
		</li>
		<li>
    	<div class="ui-grid-a">
		    <div class="ui-block-a">地段:{{$purpose->dd}}</div>
			<div class="ui-block-b">建筑风格:{{$purpose->jzfg}}</div>
		</div>
		</li>
		<li>
    	<div class="ui-grid-a">
    		<div class="ui-block-a">精装修:{{$purpose->jzx}}</div>
		    <div class="ui-block-b">优惠力度:{{$purpose->yhld}}</div>
		</div>
		</li>
			<li>
    	<div class="ui-grid-a">
    	  	<div class="ui-block-a">开盘时间:{{$purpose->kpsj}}</div>
		    <div class="ui-block-b">学区房:{{$purpose->xqf}}</div>
		</div>
		</li>
	 </ul>
	 @endforeach
	</div>
</div>
@stop
