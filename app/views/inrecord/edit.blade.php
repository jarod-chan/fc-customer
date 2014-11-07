@extends('layouts.mobile')

@section('content')
<div data-role="page" class="inrecord_edit">
  <div data-role="content">

   {{ Form::open(array('url' => "customer/$customer_id/inrecord/save",'data-ajax'=>'true')) }}
   @if($inrecord->id)
   {{ Form::hidden('id',$inrecord->id) }}
   @endif

    <ul data-role="listview" data-inset="true">
    	<li style="padding-left:1.5em" data-role="list-divider">跟进记录</li>
    	<li>
    	<div class="ui-grid-a">
		    <div class="ui-block-a fy_grid"><p class="c">跟进人:{{$inrecord->updater->name}}<p></div>
		    <div class="ui-block-b fy_grid"><p class="c">跟进日期:{{H::fmt($inrecord->update_at)}}<p></div>
		</div>
		</li>
    	<li class="fy_grid4">
    	<p class="a">跟进方式</p>{{ Form::select('type',Inrecord::typeEnums(),$inrecord->type,array('id'=>'type','data-native-menu'=>'false'))}}
    	</li>
    	<li style="padding-left:1.5em" data-role="list-divider">跟进说明</li>
    	<li class="fy_grid4">
    	{{ Form::textarea('description',$inrecord->description) }}
    	</li>
    	<li style="padding-left:1.5em" data-role="list-divider">跟进成果</li>
    	<li class="fy_grid4">
    	{{ Form::textarea('result',$inrecord->result) }}
    	</li>
    </ul>

     <p><button class="fy-btn ui-btn  ui-shadow  ui-corner-all" >保存</button></p>

  	{{ Form::close() }}

  	@if($inrecord->id)
  	{{ Form::open(array('url' => "customer/$customer_id/inrecord/$inrecord->id/delete",'data-ajax'=>'true')) }}
  	 <p><button class="fy-btn ui-btn  ui-shadow  ui-corner-all" >删除</button></p>
	{{ Form::close() }}
	 @endif

	 @include('common.pop')
	<script type="text/javascript">
	$(function(){
		var page= $(".inrecord_edit").last();
		page.find('form:eq(0)').submit(function(){
 			var msg=V.require_all(page,[
 	 	 			{sl:'#type',name:'跟进方式'}
 	 	 	]);
 			if(msg!==""){
 				pop.open(msg);
 				return false;
 			}
		});
	})
	</script>
  </div>
</div>
@stop