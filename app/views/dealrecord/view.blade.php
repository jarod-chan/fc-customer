@extends('layouts.mobile')

@section('content')
<div data-role="page" class="dealrecord_edit">
  <div data-role="content">



    <ul data-role="listview" data-inset="true" >
    	<li data-role="list-divider">成交记录</li>
		<li>
			<div class="ui-grid-a">
			    <div class="ui-block-a">{{ Form::select('',H::prepend(array('this'=>$room['project_name']),'小区'),'this',array('data-native-menu'=>'false'))}}</div>
			    <div class="ui-block-b">{{ Form::select('',H::prepend(array('this'=>$room['building_name']),'楼栋'),'this',array('data-native-menu'=>'false'))}}</div>
			</div>
		</li>
		<li>
			<div class="ui-grid-a">
			    <div class="ui-block-a">{{ Form::select('',H::prepend(array('this'=>H::nullStr($room,'buildunit_name')),'单元'),'this',array('data-native-menu'=>'false'))}}</div>
			    <div class="ui-block-b">{{ Form::select('',H::prepend(array('this'=>$room['roomName']),'房间'),'this',array('data-native-menu'=>'false'))}}</div>
			</div>
		</li>
    </ul>



  </div>
</div>
@stop