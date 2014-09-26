@extends('layouts.mobile')

@section('content')
<div data-role="page">
  <div data-role="content">

  {{ Form::open(array('url' => "customer/$customer_id/purposeroom/save",'data-ajax'=>'true')) }}
   @if($purposeroom->id)
   {{ Form::hidden('id',$purposeroom->id) }}
   @endif

    <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">意向房源</li>
		<li>
			<div class="ui-grid-a">
			    <div class="ui-block-a">{{ Form::select('',H::prepend(null,'小区'),'',array('id'=>'sel_sellproject'))}}</div>
			    <div class="ui-block-b">{{ Form::select('',H::prepend(null,'楼栋'),'',array('id'=>'sel_building'))}}</div>
			</div>
		</li>
		<li>
			<div class="ui-grid-a">
			    <div class="ui-block-a">{{ Form::select('',H::prepend(null,'单元'),'',array('id'=>'sel_buildingunit'))}}</div>
			    <div class="ui-block-b">{{ Form::select('room_id',H::prepend(array(1=>'房间1',2=>'房间2'),'房间'),$purposeroom->room_id,array('id'=>'sel_room','data-native-menu'=>'true'))}}</div>
			</div>
		</li>
		<li>
			{{ Form::text('level',$purposeroom->level,array('placeholder'=>'意向级别')) }}
		</li>
		<li>
			{{ Form::text('reason',$purposeroom->reason,array('placeholder'=>'考虑因素')) }}
		</li>
    </ul>

    <p>{{ Form::submit('保存') }}</p>

  	{{ Form::close() }}

  	 @if($purposeroom->id)
  	{{ Form::open(array('url' => "customer/$customer_id/purposeroom/$purposeroom->id/delete",'data-ajax'=>'true')) }}
  	<p>{{ Form::submit('删除') }}</p>
	{{ Form::close() }}
  	@endif

  </div>
</div>
@stop