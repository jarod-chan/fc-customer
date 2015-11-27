@extends('layouts.mobile')

@section('content')
<div data-role="page" class="customer_add">
  <div data-role="content">
  <script type="text/javascript">changeTitle('客户信息');</script>

  {{ Form::open(array('url' => 'customer/save','data-ajax'=>'true')) }}

  <?php
  	if(C::isSale()){
		$counselorSet=H::only($counselorSet,$counselor->id);
  	}
  ?>

 	 @include('common.tpl-message')
    <ul data-role="listview" data-inset="true" >
    	<li  style="padding-left:1.5em" data-role="list-divider">客户信息</li>
    	<li>
    	<div class="fy_grid">
	         <p class='a'>姓名</p>{{ Form::text('name','',array('id'=>'name')) }}
	    </div>
	    </li>
	    <li>
		<div class="fy_grid">
			<p class='a'>备注</p>{{ Form::text('remark','',array('id'=>'remark')) }}
		</div>
		</li>
		<li>
		<div class="fy_grid">
			<p class='a'>电话</p>{{ Form::text('phone','',array('id'=>'phone')) }}
		</div>
		</li>
		<li class="fy_grid">
			<p class='a'>顾问</p>{{ Form::select('counselor_id',$counselorSet,$counselor->id,array('data-native-menu'=>'true'))}}
		</li>
		<li class="fy_grid">
			<p class='a'>状态</p>{{ Form::select('state',$stateSet,'',array('id'=>'state','data-native-menu'=>'true'))}}
		</li>
		<li data-role="collapsible" data-iconpos="right" data-inset="false">
			 <h2>更多</h2>
				<ul data-role="listview">
				<li>
				<div class="fy_grid">
				<p class='a'>QQ</p>{{ Form::text('qq','') }}
				</div>
				</li>
				<li>
				<div class="fy_grid">
				<p class='a'>邮箱</p>{{ Form::text('email','') }}
				</div>
				</li>
				<li>
				<div class="fy_grid">
				<p class='a'>微信</p>{{ Form::text('weixin','') }}
				</div>
				</li>
				<li>
				<div class="fy_grid">
				<p class='a'>来源</p>{{ Form::select('from',Customer::enum('from'),'',array('data-native-menu'=>'true'))}}
				</div>
				</li>
				<li>
				<div class="fy_grid">
				<p class='a'>途径</p>{{ Form::select('way',Customer::enum('way'),'',array('data-native-menu'=>'true'))}}
				</div>
				</li>
				<li>
				<div class="fy_grid">
					<p class='c'>登记人：{{$counselor->name}}</p>
				</div>
				</li>
			 </ul>
		 </li>
    </ul>

    <p><button class="btn_save ui-btn  ui-shadow  ui-corner-all fy-btn"  >保存</button></p>


  	{{ Form::close() }}

  	@include('common.pop')

  	<script type="text/javascript">
	$(function(){
		var page= $(".customer_add").last();
		page.find('.btn_save').click(function(){
 			var msg=V.require_all(page,[
 	 	 			{sl:'#name',name:'姓名'},
 	 	 			{sl:'#phone',name:'电话'},
 	 	 			{sl:'#state',name:'状态'}
 	 	 	]);
 			if(msg!==""){
 				pop.open(msg);
 				return false;
 			}

			$.get('{{URL::to("verify")}}',{phone:page.find("#phone").val()},function(ret){
				if(ret.result){
					var data=ret.data;
					msg="<p>该电话与以下客户相同：</p>";
					msg+="<p>姓名："+data.name+"</p>";
					msg+="<p>电话："+data.phone+"</p>";
					msg+="<p>顾问："+data.counselor+"</p>";
					msg+="<p>状态："+data.state+"</p>";
					pop.open(msg);
	 				return false;
				}else{
					page.find("form").submit();
				}
			});
			return false;
		});
	})
	</script>

  </div>
</div>
@stop