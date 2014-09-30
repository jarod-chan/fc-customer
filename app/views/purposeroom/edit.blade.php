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
			    <div class="ui-block-a">{{ Form::select('',H::prepend($sellprojectSet,'小区'),$room['fsellprojectid'],array('id'=>'sel_sellproject','data-native-menu'=>'false'))}}</div>
			    <div class="ui-block-b">{{ Form::select('',H::prepend($buildingSet,'楼栋'),$room['fbuildingid'],array('id'=>'sel_building','data-native-menu'=>'false'))}}</div>
			</div>
		</li>
		<li>
			<div class="ui-grid-a">
			    <div class="ui-block-a">{{ Form::select('',H::prepend($buildingunitSet,'单元'),$room['fbuildunitid'],array('id'=>'sel_buildingunit','data-native-menu'=>'false'))}}</div>
			    <div class="ui-block-b">{{ Form::select('room_id',H::prepend($roomSet,'房间'),$room['fid'],array('id'=>'sel_room','data-native-menu'=>'false'))}}</div>
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

  	<script type="text/javascript">
	$(function(){

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
			$.get('{{URL::to("selroom/buildingunit")}}',{'val':$(this).val()},function(data){
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
			$.get('{{URL::to("selroom/room")}}',{val:$(this).val(),tag:'room'},function(data){
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