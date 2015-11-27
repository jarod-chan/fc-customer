@extends('layouts.mobile')

@section('content')
<div data-role="page" class="dealrecord_edit">
  <div data-role="content">

  {{ Form::open(array('url' => "customer/$customer_id/dealrecord/save",'data-ajax'=>'true')) }}
   @if($dealrecord->id)
   {{ Form::hidden('id',$dealrecord->id) }}
   @endif

    <ul data-role="listview" data-inset="true" >
    	<li data-role="list-divider">成交记录</li>
		<li>
			<div class="ui-grid-a">
			    <div class="ui-block-a">{{ Form::select('',H::prepend($sellprojectSet,'小区'),$room['projectid'],array('id'=>'sel_sellproject','data-native-menu'=>'true'))}}</div>
			    <div class="ui-block-b">{{ Form::select('',H::prepend($buildingSet,'楼栋'),$room['buildingid'],array('id'=>'sel_building','data-native-menu'=>'true'))}}</div>
			</div>
		</li>
		<li>
			<div class="ui-grid-a">
			    <div class="ui-block-a">{{ Form::select('',H::prepend($buildingunitSet,'单元'),$room['buildunitid'],array('id'=>'sel_buildingunit','data-native-menu'=>'true'))}}</div>
			    <div class="ui-block-b">{{ Form::select('room_id',H::prepend($roomSet,'房间'),$room['roomid'],array('id'=>'sel_room','data-native-menu'=>'true'))}}</div>
			</div>
		</li>
    </ul>

    <p><button class="fy-btn ui-btn  ui-shadow  ui-corner-all" >保存</button></p>

  	{{ Form::close() }}


  	 @if($dealrecord->id)
  	{{ Form::open(array('url' => "customer/$customer_id/dealrecord/$dealrecord->id/delete",'data-ajax'=>'true')) }}
    <p><button class="fy-btn ui-btn  ui-shadow  ui-corner-all" >删除</button></p>
	{{ Form::close() }}
  	@endif

	 @include('common.pop')
  	<script type="text/javascript">
	$(function(){
		var page= $(".dealrecord_edit").last();
		page.find('form:eq(0)').submit(function(){
 			var msg=V.require_all(page,[
 	 	 			{sl:'#sel_room',name:'房间'}
 	 	 	]);
 			if(msg!==""){
 				pop.open(msg);
 				return false;
 			}
		});

		$("#sel_sellproject").change(function(){
			$("#sel_building,#sel_buildingunit,#sel_room").find("option:gt(0)").remove();
			$("#sel_building,#sel_buildingunit,#sel_room").selectmenu('refresh', true);
			if($(this).val()=="") return;
			$.get('{{URL::to("selroom/building")}}',{val:$(this).val()},function(data){
				var toSelect=$("#sel_building");
				for(var i=0;i<data.length;i++){
					toSelect.append($("<option value='"+data[i].id+"'>"+data[i].name+"</option>"));
				}
				toSelect.selectmenu();
				toSelect.selectmenu('refresh', true);
			});
		});

		$("#sel_building").change(function(){
			$("#sel_buildingunit,#sel_room").find("option:gt(0)").remove();
			$("#sel_buildingunit,#sel_room").selectmenu('refresh', true);
			if($(this).val()=="") return;
			$.get('{{URL::to("selroom/buildingunit")}}',{'val':$(this).val(),'roomstatus':"Purchase"},function(data){
				if(data.type=="unit"){
					var toSelect=$("#sel_buildingunit");
					for(var i=0;i<data.arr.length;i++){
						toSelect.append($("<option value='"+data.arr[i].id+"'>"+data.arr[i].name+"</option>"));
					}
					toSelect.selectmenu('refresh', true);
				}else if(data.type=="room"){
					var toSelect=$("#sel_room");
					for(var i=0;i<data.arr.length;i++){
						toSelect.append($("<option value='"+data.arr[i].id+"'>"+data.arr[i].name+"</option>"));
					}
					toSelect.selectmenu('refresh', true);
				}
			});
		});

		$("#sel_buildingunit").change(function(){
			$("#sel_room").find("option:gt(0)").remove();
			$("#sel_room").selectmenu('refresh', true);
			if($(this).val()=="") return;
			$.get('{{URL::to("selroom/room")}}',{val:$(this).val(),'roomstatus':"Purchase"},function(data){
				var toSelect=$("#sel_room");
				for(var i=0;i<data.length;i++){
					toSelect.append($("<option value='"+data[i].id+"'>"+data[i].name+"</option>"));
				}
				toSelect.selectmenu('refresh', true);
			});
		});
	})
  	</script>

  </div>
</div>
@stop