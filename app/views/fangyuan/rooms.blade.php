@extends('layouts.mobileorigin')

@section('head')
<meta name="format-detection" content="telephone=no" />
<title>{{$projectname}}可售房源</title>
<style type="text/css">
.room_table{
	width: 100%;
	border: 1px solid #ccc;
	border-collapse: collapse;
}
.room_table td,th {
    border: 0.1rem solid #ccc;
    padding: 0rem 0.2rem;
}
.room_table tbody tr{
	height: 3rem;
}
.room_table td.num {
    text-align: right;
}
.room_table tbody tr.sel{
	background-color: #DBDBDB;
}

</style>
{{HTML::script('js/fastclick.js')}}
<script type="text/javascript">

	$(function() {
	    FastClick.attach(document.body);
	    $(".room_table").on("click","tbody td",function(){
	    	var tr=$(this).parent();
	    	if(tr.hasClass('sel')){
	    		return;
	    	}
	    	$(".room_table tr.sel").removeClass('sel');
	    	tr.addClass('sel');
	    });
	});
</script>
@stop

@section('content')
	<table class="room_table">
		<thead>
			<tr>
				<th>房间</th><th>面积</th><th>总价</th>
			</tr>
		</thead>
		<tbody>
			@foreach($rooms as $room)
			<tr>
				<td>{{$room['name']}}</td><td class='num'>{{$room['buildingarea']}} </td><td class='num'>{{$room['standardtotalamount']}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

@stop
