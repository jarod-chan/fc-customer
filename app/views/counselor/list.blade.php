@extends('layouts.boot')



@section('content')
<div class="container">




<h1>销售顾问</h1>

@include('common.alert')

<a class="btn btn-sm btn-primary  pull-right" href="{{ URL::to('counselor/add') }}">新增</a>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>用户名</th>
			<th>角色</th>
			<th>微信id</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($counselorList as $counselor)
		<tr>
			<td>{{ $counselor->name }}</td>
			<td>{{ $counselor->getRoleName() }}</td>
			<td>{{ $counselor->openid }}</td>

			<td>

				<!-- show the nerd (uses the show method found at GET /nerds/{id} -->
				<a class="btn btn-sm btn-primary" href="{{ URL::to('counselor/'.$counselor->id.'/edit') }}">编辑</a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
@stop