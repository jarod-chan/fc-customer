@extends('layouts.mobileorigin')

@section('head')
<meta name="format-detection" content="telephone=no" />
<title>销售项目</title>
<style type="text/css">
.project_ul  {list-style:none;margin:0px;padding: 0px;} 
.project_ul li{ border: 1px solid #ccc; height: 3rem; line-height: 3rem; padding-left: 0.5rem; margin-top: 0.1rem;}
.project_ul li.sel{ background-color: #ccc;}
</style>
{{HTML::script('js/fastclick.js')}}
<script type="text/javascript">

	$(function() {
	    FastClick.attach(document.body);
	    $(".project_ul").on("click","li",function(){
	    	var li=$(this);
	    	if(li.hasClass("sel")){
	    		return;
	    	}
	    	li.addClass('sel');
	    	var projectid=li.data("id");
	    	var projectname=li.data("name");
	    	window.open('{{URL::to("fangyuan/project/rooms")}}?projectid='+projectid+'&projectname='+projectname,'_self');
	    });
	});
</script>
@stop

@section('content')
	<ul class="project_ul">
	@foreach($projects as $porject)
	    <li data-id="{{urlencode($porject['id'])}}" data-name="{{$porject['name']}}">{{$porject['name']}}</li>
	@endforeach
	</ul>
@stop
