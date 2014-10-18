@extends('layouts.mobile')

@section('content')
<div data-role="page" class="customer_edit" data-url='{{ URL::to("customer/$customer->id/edit") }}' >
    <div data-role="content">

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

    {{ Form::open(array('url' => 'customer/save','data-ajax'=>'true')) }}
	{{ Form::hidden('id',$customer->id) }}
    <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">客户信息</li>
    	<li>
    	<div class="fy_grid">
		 <p class='a'>姓名</p>{{ Form::text('name',$customer->name) }}
		</div>
		</li>
		<li>
		<div class="fy_grid">
		 <p class='a'>手机</p>{{ Form::text('phone',$customer->phone) }}
		</div>
		</li>
		<li class="ui-field-contain">
			{{ Form::select('counselor_id',H::prepend($counselorSet,'销售顾问'),$customer->counselor_id,array('data-native-menu'=>'false'))}}
		</li>
		<li class="ui-field-contain">
			{{ Form::select('state',H::prepend($stateSet,'状态'),$customer->state,array('data-native-menu'=>'false'))}}
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
				<p class='a'>来源</p>{{ Form::text('from',$customer->from) }}
				</div>
				</li>
				<li>
				<div class="fy_grid">
				<p class='a'>途径</p>{{ Form::text('way',$customer->way) }}
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

    <p><button class="fy-btn ui-btn  ui-shadow  ui-corner-all"  >保存</button></p>

  	{{ Form::close() }}
  	<script type="text/javascript">
	$(function(){
		var page=$(".customer_edit").last();
		var form=page.find("form");
 		page.find(".btn_delete").click(function(){
			$("body").pagecontainer("change",'{{ URL::to("customer/save") }}',{type:'post',data:form.serialize(),changeHash:false});
			return false;
		});
	})
	</script>

  </div>
</div>



@stop