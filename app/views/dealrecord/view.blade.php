@extends('layouts.mobile')

@section('content')
<div data-role="page" class="dealrecord_edit">
  <div data-role="content">



    <ul data-role="listview" data-inset="true" >
    	<li data-role="list-divider">成交记录</li>
		<li>
			<div class="ui-grid-a">
			    <div class="ui-block-a">{{ Form::select('',H::prepend(array('this'=>$room['project_name']),'小区'),'this',array('data-native-menu'=>'true'))}}</div>
			    <div class="ui-block-b">{{ Form::select('',H::prepend(array('this'=>$room['building_name']),'楼栋'),'this',array('data-native-menu'=>'true'))}}</div>
			</div>
		</li>
		<li>
			<div class="ui-grid-a">
			    <div class="ui-block-a">{{ Form::select('',H::prepend(array('this'=>H::nullStr($room,'buildunit_name')),'单元'),'this',array("data-native-menu"=>"true"))}}</div>
			    <div class="ui-block-b">{{ Form::select('',H::prepend(array('this'=>$room['roomName']),'房间'),'this',array("data-native-menu"=>"true"))}}</div>
			</div>
		</li>
    </ul>

  	 @if($hasCommission)
  	 <div class="ui-corner-all custom-corners">
			<div class="ui-bar ui-bar-a">
				<h3>系统信息</h3>
			</div>
			<div class="ui-body ui-body-a">
				<p>该成交记录存在佣金记录，无法删除或者修改。</p>
			</div>
	</div>
  	 @else
  	{{ Form::open(array('url' => "customer/$customer_id/dealrecord/$dealrecord_id/delete",'data-ajax'=>'true')) }}
    <p><button class="fy-btn ui-btn  ui-shadow  ui-corner-all" >删除</button></p>
	{{ Form::close() }}
  	@endif

  </div>
</div>
@stop