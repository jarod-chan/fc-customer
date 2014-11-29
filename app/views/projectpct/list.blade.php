@extends('layouts.boot')



@section('content')
<div class="container">

<h1>佣金比率</h1>

@include('common.alert')

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>销售项目</th>
			<th>佣金比率</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($sellProjectSet as $item)
		<tr>
			<td>{{$item['name']}}</td>
			<td>{{H::trimz($item['pct'])}}</td>
			<td>
				<a class="btn btn-sm btn-primary" href="{{ URL::to('projectpct/edit?'.$item['param']) }}">编辑</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

</div>
@stop