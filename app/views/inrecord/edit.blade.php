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
		    <div class="ui-block-a">跟进人:{{$inrecord->updater->name}}</div>
		    <div class="ui-block-b">跟进日期:{{$inrecord->update_at}}</div>
		</div>
		</li>
    	<li>
    	{{ Form::select('type',H::prepend(Inrecord::typeEnums(),'跟进方式'),$inrecord->type,array('data-native-menu'=>'false'))}}
    	</li>
    	<li>
    	{{ Form::text('description',$inrecord->description,array('placeholder'=>'跟进说明')) }}
    	</li>
    	<li>
    	{{ Form::text('result',$inrecord->description,array('placeholder'=>'跟进成果')) }}
    	</li>
    </ul>

    <p>{{ Form::submit('保存') }}</p>

  	{{ Form::close() }}

  	@if($inrecord->id)
  	{{ Form::open(array('url' => "customer/$customer_id/inrecord/$inrecord->id/delete",'data-ajax'=>'true')) }}
  	<p>{{ Form::submit('删除') }}</p>
	{{ Form::close() }}
	 @endif
  </div>
</div>
@stop