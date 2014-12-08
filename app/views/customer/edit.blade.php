@extends('layouts.mobile')

@section('content')
<div data-role="page" class="customer_edit" data-url='{{ URL::to("customer/$customer->id/edit") }}' >
    <div data-role="content">
     <script type="text/javascript">changeTitle('客户信息');</script>

    @if (Session::has('message'))
  	<div class="ui-corner-all custom-corners" >
	  <div class="ui-bar ui-bar-a">
	    <h3>系统信息</h3>
	  </div>
	  <div class="ui-body ui-body-a">
	    <p>{{Session::get('message')}}</p>
	  </div>
	</div>
	@endif

	<div class="fy-body">
    {{ Form::open(array('url' => 'customer/save','data-ajax'=>'true')) }}
	{{ Form::hidden('id',$customer->id) }}

	 <?php
	  	$counselor_select=array('data-native-menu'=>'false');
	  	if(C::isSale()){
			$counselor_select=array('data-native-menu'=>'false', 'disabled'=>"disabled");
	  	}
	  ?>
    <ul data-role="listview" data-inset="true">
    	<li  style="padding-left:1.5em" data-role="list-divider">客户信息</li>
    	<li>
    	<div class="fy_grid">
		 <p class='a'>姓名</p>{{ Form::text('name',$customer->name,array('id'=>'name')) }}
		</div>
		</li>
		<li>
		<div class="fy_grid">
		 <p class='a'>手机</p>{{ Form::text('phone',$customer->phone,array('id'=>'phone')) }}
		</div>
		</li>
		<li class="fy_grid">
			<p class='a'>顾问</p>{{ Form::select('counselor_id',$counselorSet,$customer->counselor_id,$counselor_select)}}
		</li>
		<li class="fy_grid">
			<p class='a'>状态</p>{{ Form::select('state',$stateSet,$customer->state,array('id'=>'state','data-native-menu'=>'false'))}}
		</li>


		 <li data-role="collapsible" data-iconpos="right" data-inset="false">
		    <h2>更多</h2>
		    <ul data-role="listview">
	     		<li>
	     		<div class="fy_grid">
				<p class='a'>QQ</p>{{ Form::text('qq',$customer->qq) }}
				</div>
				</li>
				<li>
				<div class="fy_grid">
				<p class='a'>邮箱</p>{{ Form::text('email',$customer->email) }}
				</div>
				</li>
				<li>
				<div class="fy_grid">
				<p class='a'>微信</p>{{ Form::text('weixin',$customer->weixin) }}
				</div>
				</li>
				<li>
				<div class="fy_grid">
				<p class='a'>来源</p>{{ Form::select('from',Customer::enum('from'),$customer->from,array('data-native-menu'=>'false'))}}
				</div>
				</li>
				<li>
				<div class="fy_grid">
				<p class='a'>途径</p>{{ Form::select('way',Customer::enum('way'),$customer->way,array('data-native-menu'=>'false'))}}
				</div>
				</li>
				<li>
				<div class="fy_grid">
					<p class='c'>登记人：{{$customer->register->name}}</p>
				</div>
				</li>
		    </ul>
		  </li>
    </ul>

    <ul data-role="listview" data-inset="true">
	    <li><a href='{{ URL::to("customer/$customer->id/purpose/list") }}' >意向信息</a></li>
	    <li><a href='{{ URL::to("customer/$customer->id/purposeroom/list") }}'>意向房源</a></li>
	    <li><a href='{{ URL::to("customer/$customer->id/inrecord/list") }}'>跟进记录</a></li>
	    <li><a href='{{ URL::to("customer/$customer->id/dealrecord/list") }}'>成交记录</a></li>
	</ul>

	<p><button class="fy-btn btn_save ui-btn  ui-shadow  ui-corner-all"  >保存</button></p>
  	{{ Form::close() }}

	@include('common.pop')
  	<script type="text/javascript">
	$(function(){

		var page=$(".customer_edit").last();
		var form=page.find("form");
 		page.find(".btn_save").click(function(){
 			var msg=V.require_all(page,[
 	 			           	 		{sl:'#name',name:'姓名'},
 	 			           	 		{sl:'#phone',name:'手机'},
 	 			           	 		{sl:'#state',name:'状态'}
 	 			           	 		]);
			if(msg!==""){
				pop.open(msg);
				return false;
			}
			msg=V.phone(page.find("#phone"),'手机号码');
			if(msg!==""){
 				pop.open(msg);
 				return false;
 			}

			$.get('{{URL::to("verify")}}',{phone:page.find("#phone").val(),customer_id:{{$customer->id}}},function(ret){
				if(ret.result){
					var data=ret.data;
					msg="<p>该手机号与以下客户相同：</p>";
					msg+="<p>姓名："+data.name+"</p>";
					msg+="<p>手机："+data.phone+"</p>";
					msg+="<p>顾问："+data.counselor+"</p>";
					msg+="<p>状态："+data.state+"</p>";
					pop.open(msg);
	 				return false;
				}else{
					$("body").pagecontainer("change",'{{ URL::to("customer/save") }}',{type:'post',data:form.serialize(),changeHash:false});
				}
			});
			return false;
		});
	})
	</script>
	</div>
  </div>
</div>



@stop