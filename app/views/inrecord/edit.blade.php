@extends('layouts.mobile')

@section('content')
<div data-role="page">
  <div data-role="content">

   {{ Form::open(array('url' => "customer/$customer_id/inrecord/save",'data-ajax'=>'true')) }}
   @if($inrecord->id)
   {{ Form::hidden('id',$inrecord->id) }}
   @endif

    <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">跟进记录</li>
    	<li>
    	<div class="ui-grid-a">
		    <div class="ui-block-a fy_grid"><p class="c">跟进人:{{$inrecord->updater->name}}<p></div>
		    <div class="ui-block-b fy_grid"><p class="c">跟进日期:{{$inrecord->update_at}}<p></div>
		</div>
		</li>
    	<li>
    	{{ Form::select('type',H::prepend(Inrecord::typeEnums(),'跟进方式'),$inrecord->type,array('data-native-menu'=>'false'))}}
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class="a">跟进说明</p>{{ Form::text('description',$inrecord->description) }}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class="a">跟进成果</p>{{ Form::text('result',$inrecord->result) }}
    	</div>
    	</li>
    </ul>

     <p><button class="fy-btn ui-btn  ui-shadow  ui-corner-all" >保存</button></p>

  	{{ Form::close() }}

  	@if($inrecord->id)
  	{{ Form::open(array('url' => "customer/$customer_id/inrecord/$inrecord->id/delete",'data-ajax'=>'true')) }}
  	 <p><button class="fy-btn ui-btn  ui-shadow  ui-corner-all" >删除</button></p>
	{{ Form::close() }}
	 @endif
  </div>
</div>
@stop