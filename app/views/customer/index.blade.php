@extends('layouts.mobile')

@section('content')
<div data-role="page" >
    <div data-role="content">
     <h3 class="ui-bar ui-bar-a">客户列表</h3>

	{{ Form::open(array('url' => 'customer/'.$state,'data-ajax'=>'true','method'=>'get')) }}
	<ul data-role="listview" data-inset="true" >
    	<li>
	         {{ Form::select('type',array('name'=>'姓名','phone'=>'电话'),$type)}}
	    </li>
	    <li>
    	<div class="fy_grid">
	         <p class='a'>关键字</p>
	         <input type="text" name="key" id="key" value="{{$key}}">
	    </div>
	    </li>
	    <li>
	    	 <button class="fy-btn ui-mini ui-btn  ui-shadow  ui-corner-all" data-mini="true"  >查询</button>
	    </li>
	 </ul>
	{{ Form::close() }}

	@foreach($customerSet as $customer)
	 <ul class="item" data-role="listview" data-inset="true">
		<li><a href='{{ URL::to("customer/$customer->id/edit") }}'>
                <h2>客户：{{$customer->name}}</h2>
                <p>更新时间：{{$customer->update_at}}</p>
            </a>
        </li>
	</ul>
	@endforeach

	</div>
</div>
@stop
