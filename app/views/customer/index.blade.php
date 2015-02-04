@extends('layouts.mobile')

@section('content')
<div data-role="page" >
    <div data-role="content">
    <script type="text/javascript">changeTitle('客户列表');</script>

	{{ Form::open(array('url' => 'customer/'.$state,'data-ajax'=>'true','method'=>'get')) }}
	 <div class="ui-body ui-body-a" style="padding: 0px;margin: 0 -0.6em 0 -0.6em;background-color: #ededed;height: 3.2em;">
	<div class="fy-query">
	    <div class="a"  >{{ Form::select('type',array('name'=>'姓名','phone'=>'电话'),$type)}}</div>
	    <div class="b" ><input type="text" name="key" id="key" value="{{$key}}"> <button class="fy-btn ui-btn  ui-corner-all"  >查询</button></div>
	</div>
	</div>
	{{ Form::close() }}


	@foreach($customerSet as $customer)
	 <ul class="item" data-role="listview" data-inset="true">
		<li><a href='{{ URL::to("customer/$customer->id/edit") }}'>
                <h2>客户：{{$customer->name}}({{$customer->remark}})</h2>
                <p>更新时间：{{$customer->update_at}}</p>
            </a>
        </li>
	</ul>
	@endforeach



	</div>
</div>
@stop
