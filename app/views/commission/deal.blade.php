@extends('layouts.mobile')

@section('content')
<div data-role="page" class="commmission_deal">
  <div data-role="content"  >

  {{ Form::open(array('url' => "commission/$dealrecord->id/save",'data-ajax'=>'true')) }}

    <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">佣金结算</li>
		<li>
			房间信息
		</li>
    </ul>

    <div class="item_div">
    @foreach($dealrecord->commissions as $commission)
    <ul data-role="listview" data-inset="true">
		<li data-icon="delete" class="btn_delete"><a href="#">&nbsp;</a></li>
		<li><input type="hidden"  name="commissionSet[-][id]" value="{{$commission->id}}"  ><input type="text"  name="commissionSet[-][percent]" value="{{$commission->percent}}"  placeholder="结算比例"></li>
		<li><input type="text"  name="commissionSet[-][commission]" value="{{$commission->commission}}"  placeholder='金额'></li>
		<li>{{ Form::select("commissionSet[-][counselor_id]",H::prepend($counselorSet,"销售顾问"),$commission->counselor_id,array("data-native-menu"=>"false"))}}</li>
		<li><input type="date"  name="commissionSet[-][comdate_at]" value="{{$commission->comdate_at}}"  placeholder="日期"></li>
    </ul>
    @endforeach
    </div>
    <button  class="btn_add ui-btn  ui-shadow  ui-corner-all" >新增</button>


    <p>{{ Form::submit('保存') }}</p>

  	{{ Form::close() }}
	<script type="text/javascript">
	$(function(){
		var page=$(".commmission_deal").last();
		var item=page.find(".item_div");
		page.find(".btn_add").click(function(){
			var ul=$('<ul data-role="listview" data-inset="true"></ul>');
			$('<li data-icon="delete" class="btn_delete"><a href="#">&nbsp;</a></li>').appendTo(ul);
			$('<li><input type="hidden"  name="commissionSet[-][id]" value="" ><input type="text"  name="commissionSet[-][percent]" value=""  placeholder="结算比例"></li>').appendTo(ul);
			$('<li><input type="text"  name="commissionSet[-][commission]" value=""  placeholder="金额"></li>').appendTo(ul);
			$('<li>{{ Form::select("commissionSet[-][counselor_id]",H::prepend($counselorSet,"销售顾问"),'',array("data-native-menu"=>"false"))}}</li>').appendTo(ul);
			$('<li><input type="date"  name="commissionSet[-][comdate_at]" value=""  placeholder="日期"></li>').appendTo(ul);

			item.append(ul).trigger("create");
			ul.listview("refresh");
			ul.find(".btn_delete").click(function(){
				$(this).parents("ul").remove();
				return false;
			});
			return false;
		});

		var form=page.find("form");
		form.submit(function(){
			item.find('ul').formatName();
		})

		item.find(".btn_delete").click(function(){
			$(this).parents("ul").remove();
			return false;
		})
	})
	</script>
  </div>
</div>
@stop