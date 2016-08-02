@extends('layouts.boot')



@section('content')
<div class="container">

<h1>项目房源</h1>

@include('common.alert')

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>销售项目</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($sellProjectSet as $item)
		<tr>
			<td>{{$item['name']}}</td>
			<td>

				@if ($item['osh'])
				    <span class="label label-success">显示</span>
				@else
				    <span class="label label-warning">隐藏</span>
				@endif

			</td>
			<td>
				<button class="btn_switch btn btn-sm btn-primary" data-id="{{$item['id']}}">切换</button>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

</div>
<script type="text/javascript">
	$(function(){
		$(".table").on("click",".btn_switch",function(){
			var id=$(this).data("id");
			$('<form/>',{action:'{{ URL::to('projectosh/doswitch') }}',method:'post'})
			.append($('<input type="hidden" name="id" />').val(id))
			.appendTo($("body"))
			.submit();	
		});
	})
</script>

@stop