@extends('layouts.mobile')

@section('content')
<div data-role="page" >
    <div data-role="content">
     <h3 class="ui-bar ui-bar-a">客户列表</h3>

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
