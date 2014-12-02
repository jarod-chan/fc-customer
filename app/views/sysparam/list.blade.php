@extends('layouts.boot')



@section('content')
<div class="container">

<h1>全局参数</h1>

@include('common.alert')

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>参数名称</th>
			<th>参数值</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($sysparamSet as $item)
		<tr>
			<td>{{$item['name']}}</td>
			<td>{{$item['value']}}</td>
			<td>
				<a class="btn btn-sm btn-primary" href="{{ URL::to('sysparam/edit/'.$item['key']) }}">编辑</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

</div>
@stop