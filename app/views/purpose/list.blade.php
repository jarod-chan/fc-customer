@extends('layouts.mobile')

@section('content')
<div data-role="page" class="purpose_list" data-url='{{ URL::to("customer/$customer_id/purpose/list") }}'>
    <div data-role="content">
    <script type="text/javascript">changeTitle('意向信息')</script>

	 <p><button class="fy-btn ui-btn  ui-shadow  ui-corner-all" onclick="changePage('{{ URL::to("customer/$customer_id/purpose/add") }}')">新增</button></p>

	@foreach($purposeList as $purpose)
	 <ul class="item" data-role="listview" data-inset="true">
	 	<li><a href='{{ URL::to("customer/$customer_id/purpose/$purpose->id/edit") }}' >{{$purpose->id}}</a></li>
    	<li>
    	<div class="ui-grid-a">
		    <div class="ui-block-a">客户级别:{{$purpose->name('khjb')}}</div>
		    <div class="ui-block-b">意向强度:{{$purpose->name('yxqd')}}</div>
		</div>
		</li>
		<li>
    	<div class="ui-grid-a">
		    <div class="ui-block-a">购房动机:{{$purpose->name('gfdj')}}</div>
		    <div class="ui-block-b">住宅类型:{{$purpose->name('zzlx')}}</div>
		</div>
		</li>
		<li>
    	<div class="ui-grid-a">
		    <div class="ui-block-a">户型类型:{{$purpose->name('hxlx')}}</div>
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
			<div class="ui-block-b">建筑风格:{{$purpose->name('jzfg')}}</div>
		</div>
		</li>
		<li>
    	<div class="ui-grid-a">
    		<div class="ui-block-a">精装修:{{$purpose->name('jzx')}}</div>
		    <div class="ui-block-b">优惠力度:{{$purpose->name('yhld')}}</div>
		</div>
		</li>
			<li>
    	<div class="ui-grid-a">
    	  	<div class="ui-block-a">开盘时间:{{$purpose->kpsj}}</div>
		    <div class="ui-block-b">学区房:{{$purpose->name('xqf')}}</div>
		</div>
		</li>
	 </ul>
	 @endforeach
	</div>
</div>
@stop
