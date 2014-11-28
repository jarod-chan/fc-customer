@extends('layouts.mobile')

@section('content')
<div data-role="page" class="purpose_list" data-url='{{ URL::to("customer/$customer_id/inrecord/list") }}'>
    <div data-role="content">
     <script type="text/javascript">changeTitle('跟进记录')</script>

	 <p><button class="fy-btn ui-btn  ui-shadow  ui-corner-all" onclick="changePage('{{ URL::to("customer/$customer_id/inrecord/add") }}')">新增</button></p>

	@foreach($inrecordList as $inrecord)
	 <ul class="item" data-role="listview" data-inset="true">
	 	 <li><a href='{{ URL::to("customer/$customer_id/inrecord/$inrecord->id/edit") }}' >{{$inrecord->id}}</a></li>
    	<li>
    	<div class="ui-grid-a">
		    <div class="ui-block-a">跟进人:{{$inrecord->updater->name}}</div>
		    <div class="ui-block-b">跟进日期:{{H::fmt($inrecord->create_at)}}</div>
		</div>
		</li>
		<li>
		跟进方式：{{$inrecord->getTypeName()}}
		</li>
		<li>
		跟进说明：{{$inrecord->description}}
		</li>
		<li>
		跟进结果：{{$inrecord->result}}
		</li>
	 </ul>
	 @endforeach


	</div>
</div>
@stop
