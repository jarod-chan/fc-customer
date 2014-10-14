@extends('layouts.mobile')

@section('content')
<div data-role="page" class="commmission_deal">
  <div data-role="content"  >

  {{ Form::open(array('url' => "commission/$dealrecord->id/save",'data-ajax'=>'true')) }}
  <?php
     $room=$dealrecord->room();//d($room);
  ?>

    <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">佣金结算</li>
	 	 @if($room)
		<li>
		房间:{{$room['project_name'].$room['building_name'].H::nullStr($room,'buildunit_name').$room['roomName']}}
		</li>
		@endif
		<li>
		总价:{{$room['contractTotalAmount']}}
		</li>
		<li>
		{{ Form::text('percent',H::trimz($dealrecord->percent),array('placeholder'=>'佣金比率','id'=>'percent')) }}
		</li>
		<li>
		应结佣金:<span id="span_commission">{{H::trimz($dealrecord->commission)}}</span><input type="hidden" id="commission" name="commission" value="{{$dealrecord->commission}}"  >
		</li>
    </ul>

    <div class="item_div">
    @foreach($dealrecord->commissions as $commission)
    <ul class="dl_item" data-role="listview" data-inset="true">
		<li data-icon="delete" class="btn_delete"><a href="#">&nbsp;</a></li>
		<li>
			<input type="hidden"  name="commissionSet[-][id]" value="{{$commission->id}}"  >
			<input type="text" class="item_percent" name="commissionSet[-][percent]" value="{{H::trimz($commission->percent)}}"  placeholder="结算比例">
		</li>
		<li>
			<input type="hidden"  class="item_commission"   name="commissionSet[-][commission]" value="{{$commission->commission}}">
			金额：<span class="sp_item_commission">{{H::trimz($commission->commission)}}</span>
		</li>
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
		//------------------------------------------------------
		var page=$(".commmission_deal").last();
		var tamount={{$room['contractTotalAmount']}};
		var sp_commission=page.find('#span_commission');
		var ip_commission=page.find('#commission');

		@if($dealrecord->commission)
			var commission={{$dealrecord->commission}};
		@else
			var commission='0';
		@endif


		page.find('#percent').blur(function(){
			var ts=$(this);
			var percent=ts.val();
			if(!isF(percent,"+")){
				ts.val("");
				return;
			}
			percent=$.trim(percent);
			ts.val(percent);
			commission=calc.mul(tamount,percent);
			sp_commission.html(commission);
			ip_commission.val(commission);
			page.find(".item_percent").triggerHandler('blur');
		});

		//------------------------------------------------------
		page.find(".dl_item").each(function(){
			var item_percent=$(this).find(".item_percent");
			var ip_item_commission=$(this).find(".item_commission");
			item_percent.blur(function(){
				var ts=item_percent;
				var percent=ts.val();
				if(!isF(percent,"+")){
					ts.val("");
					return;
				}
				percent=$.trim(percent);
				ts.val(percent);
				item_commission=calc.mul(commission,percent);
				ip_item_commission.val(item_commission);
				ip_item_commission.next().html(item_commission);
			});
		})

		//------------------------------------------------------
		var item=page.find(".item_div");


		page.find(".btn_add").click(function(){
			var ul=$('<ul data-role="listview" data-inset="true"></ul>');
			$('<li data-icon="delete" class="btn_delete"><a href="#">&nbsp;</a></li>').appendTo(ul);
			$('<li><input type="hidden"  name="commissionSet[-][id]" value="" ><input type="text"  class="item_percent"  name="commissionSet[-][percent]" value=""  placeholder="结算比例"></li>').appendTo(ul);
			$('<li><input type="hidden" class="item_commission" name="commissionSet[-][commission]" value="" >金额：<span class="sp_item_commission"></span></li>').appendTo(ul);
			$('<li>{{ Form::select("commissionSet[-][counselor_id]",H::prepend($counselorSet,"销售顾问"),'',array("data-native-menu"=>"false"))}}</li>').appendTo(ul);
			$('<li><input type="date"  name="commissionSet[-][comdate_at]" value=""  placeholder="日期"></li>').appendTo(ul);

			(function(){
				var item_percent=ul.find(".item_percent");
				var ip_item_commission=ul.find(".item_commission");
				item_percent.blur(function(){
					var ts=item_percent;
					var percent=ts.val();
					if(!isF(percent,"+")){
						ts.val("");
						return;
					}
					percent=$.trim(percent);
					ts.val(percent);
					item_commission=calc.mul(commission,percent);
					ip_item_commission.val(item_commission);
					ip_item_commission.next().html(item_commission);
				});
			}())

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