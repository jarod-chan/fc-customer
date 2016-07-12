@extends('layouts.mobilescroll')

@section('head')
   	{{HTML::style('plug/scroll/scroll.css')}}
    {{HTML::script('plug/scroll/iScrollv4.2.5.js')}}
    {{HTML::script('views/customer.js')}} 
@stop

@section('content')
<div data-role="page" class="customer_index">
	<script type="text/javascript">
	changeTitle('客户列表');
	PG.setState('{{$state}}').setUrl('{{URL::to("customer/$state/query")}}').setAll('{{$type}}','{{$key}}','{{$offset}}');
	</script>
    <div data-role="content">

	<div class="ui-body ui-body-a fy-query-scroll" style="height: 3.2em;">
	<div class="fy-query">
	    <div class="a" >{{ Form::select('type',array('name'=>'姓名','phone'=>'电话'),$type,array('id'=>'type'))}}</div>
	    <div class="b" ><input type="text" name="key" id="key" value="{{$key}}"><button id="btn_query" class="fy-btn ui-btn  ui-corner-all"  >查询</button></div>
	</div>
	</div>



	<div id="wrapper" >
	<div id="scroller">

	<div id="item_div">
	@foreach($customerSet as $customer)
	 <ul class="item" data-role="listview" data-inset="true">
		<li><a href='{{ URL::to("customer/$customer->id/edit") }}'>
                <h2>客户：{{$customer->name}}@if(!empty($customer->remark)&&!ctype_space($customer->remark))({{$customer->remark}})@endif</h2>
                <p>更新时间：{{$customer->update_at}}</p>
            </a>
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
