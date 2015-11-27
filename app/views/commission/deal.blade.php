@extends('layouts.mobile')

@section('content')
<div data-role="page" class="commmission_deal">
  <div data-role="content"  >

  {{ Form::open(array('url' => "commission/$dealrecord->id/save?state=$state&key=$key",'data-ajax'=>'true')) }}
  <?php
     $room=$dealrecord->room();//d($room);
  ?>

    <ul data-role="listview" data-inset="true">
    	<li style="padding-left:1.5em" data-role="list-divider">佣金结算</li>
	 	 @if($room)
		<li>
		<div class="fy_grid4">
		<p class="c">房间：{{$room['project_name'].$room['building_name'].H::nullStr($room,'buildunit_name').$room['roomName']}}</p>
		</div>
		</li>
		@endif
		<li>
		<div class="fy_grid4">
		<p class="c">总价：{{$room['contractTotalAmount']}}</p>
		</div>
		</li>
		<li>
		<div class="fy_grid4">
		   <p class="a">佣金比率</p>{{ Form::text('percent',H::trimz($dealrecord->percent),array('id'=>'percent','placeholder'=>'%')) }}</p>
		</div>
		</li>
		<li>
		<div class="fy_grid4">
		<p class="c">应结佣金：<span id="span_commission">{{H::trimz($dealrecord->commission)}}</span></p><input type="hidden" id="commission" name="commission" value="{{$dealrecord->commission}}"  >
		</div>
		</li>
    </ul>

    <div class="item_div">
    @foreach($dealrecord->commissions as $commission)
    <ul class="dl_item" data-role="listview" data-inset="true">
		<li data-icon="delete" class="btn_delete"><a href="#">&nbsp;<input type="hidden"  name="commissionSet[-][id]" value="{{$commission->id}}"  ></a></li>
		<li>
			<div class="fy_grid4">
			<p class="a">结算比例</p><input type="text" class="item_percent" name="commissionSet[-][percent]" value="{{H::trimz($commission->percent)}}"  placeholder="%">
			</div>
		</li>
		<li>
			<div class="fy_grid4">
			<p class="c">金额：<input type="hidden"  class="item_commission"   name="commissionSet[-][commission]" value="{{$commission->commission}}"><span class="sp_item_commission">{{H::trimz($commission->commission)}}</span></p>
			</div>
		</li>
		<li>
		<div class="fy_grid4">
			<p class='a'>顾问</p>{{ Form::select("commissionSet[-][counselor_id]",$counselorSet,$commission->counselor_id,array("data-native-menu"=>"true"))}}
		</div>
		</li>
		<li>
		<div class="fy_grid4">
		<p class="a">日期</p><input type="date"  class="item_date" name="commissionSet[-][comdate_at]" value="{{$commission->comdate_at}}" >
		</div>
		</li>
    </ul>
    @endforeach
    </div>
    <button class="fy-btn btn_add ui-btn  ui-corner-all"   >新增</button>
   <button class="fy-btn ui-btn   ui-corner-all" >保存</button>

  	{{ Form::close() }}

  	@include('common.pop')
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
			commission=calc.mul(commission,'0.01');
			sp_commission.html(commission);
			ip_commission.val(commission);

			page.find(".item_percent").each(function(){
				$(this).triggerHandler('blur');
			});
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
				item_commission=calc.mul(item_commission,'0.01');
				ip_item_commission.val(item_commission);
				ip_item_commission.next().html(item_commission);
			});
		})

		//------------------------------------------------------
		var item=page.find(".item_div");


		page.find(".btn_add").click(function(){
			var ul=$('<ul data-role="listview" data-inset="true"></ul>');
			$('<li data-icon="delete" class="btn_delete"><a href="#">&nbsp;<input type="hidden"  name="commissionSet[-][id]" value=""  ></a></li>').appendTo(ul);
			$('<li><div class="fy_grid4"><p class="a">结算比例</p><input type="text" class="item_percent" name="commissionSet[-][percent]" value=""  placeholder="%"></div></li>').appendTo(ul);
			$('<li><div class="fy_grid4"><p class="c">金额：<input type="hidden"  class="item_commission"   name="commissionSet[-][commission]" value=""><span class="sp_item_commission"></span></p></div></li>').appendTo(ul);
			$('<li><div class="fy_grid4"><p class="a">顾问</p>{{ Form::select("commissionSet[-][counselor_id]",$counselorSet,'',array("data-native-menu"=>"true"))}}</li>').appendTo(ul);
			$('<li><div class="fy_grid4"><p class="a">日期</p><input type="date"  class="item_date"  name="commissionSet[-][comdate_at]" value="" ></div></li>').appendTo(ul);

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
					item_commission=calc.mul(item_commission,'0.01');
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
			var msg=V.require_all(page,[
			       {sl:'#percent',name:'佣金比率'}
			]);

			item.find("ul").each(function(i){
				var ul=$(this);
				msg+=V.require(ul.find('.item_percent'),'行'+(i+1)+'结算比例');
				msg+=V.require(ul.find('select'),'行'+(i+1)+'顾问');
				msg+=V.require(ul.find('.item_date'),'行'+(i+1)+'日期');
			});
 	 	 	if(msg!==""){
 	 	 	 	pop.open(msg);
 	 	 	 	return false;
 	 	 	 }
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