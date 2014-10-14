@extends('layouts.mobile')

@section('content')
<div data-role="page" >
    <div data-role="content">
     <h3 class="ui-bar ui-bar-a">客户列表</h3>

	 <div class="ui-body ui-body-a ui-corner-all">
	{{ Form::open(array('url' => 'customer/'.$state,'data-ajax'=>'true','method'=>'get')) }}
	    <div class="ui-field-contain">
	         <label for="text-12">查询内容:</label>
	         {{ Form::select('type',array('name'=>'姓名','phone'=>'电话'),$type)}}
	    </div>
	    <div class="ui-field-contain">
	         <label for="key">关键字</label>
	         <input type="search" data-mini="true" name="key" id="key" value="{{$key}}">
	    </div>
	    <div class="ui-field-contain">
	    	<button class="ui-mini ui-btn  ui-shadow  ui-corner-all" data-mini="true"  >查询</button>
	    </div>
	{{ Form::close() }}
	</div>


	@foreach($customerSet as $customer)
	 <ul class="item" data-role="listview" data-inset="true">
		<li><a href='{{ URL::to("customer/$customer->id/edit") }}'>
                <h2>{{$customer->name}}</h2>
                <p>更新时间：{{$customer->update_at}}</p>
            </a>
        </li>
	</ul>
	@endforeach

	</div>
</div>
@stop
