@extends('layouts.mobile')

@section('content')
<div data-role="page" class="customer_add">
  <div data-role="content">
  <script type="text/javascript">changeTitle('客户信息');</script>

  {{ Form::open(array('url' => 'customer/save','data-ajax'=>'true')) }}

    <ul data-role="listview" data-inset="true" >
    	<li  style="padding-left:1.5em" data-role="list-divider">客户信息</li>
    	<li>
    	<div class="fy_grid">
	         <p class='a'>姓名</p>{{ Form::text('name','',array('id'=>'name')) }}
	    </div>
	    </li>
		<li>
		<div class="fy_grid">
			<p class='a'>手机</p>{{ Form::text('phone','',array('id'=>'phone')) }}
		</div>
		</li>
		<li class="fy_grid">
			<p class='a'>顾问</p>{{ Form::select('counselor_id',H::prepend($counselorSet,'顾问'),$counselor->id,array('data-native-menu'=>'false'))}}
		</li>
		<li class="fy_grid">
			<p class='a'>状态</p>{{ Form::select('state',H::prepend($stateSet,'状态'),'',array('id'=>'state','data-native-menu'=>'false'))}}
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
				<p class='a'>来源</p>{{ Form::select('from',H::prepend(Customer::enum('from'),'来源'),'',array('data-native-menu'=>'false'))}}
				</div>
				</li>
				<li>
				<div class="fy_grid">
				<p class='a'>途径</p>{{ Form::select('way',H::prepend(Customer::enum('way'),'途径'),'',array('data-native-menu'=>'false'))}}
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

    <p><button class="ui-btn  ui-shadow  ui-corner-all fy-btn"  >保存</button></p>


  	{{ Form::close() }}

  	@include('common.pop')

  	<script type="text/javascript">
	$(function(){
		var page= $(".customer_add").last();
		page.find('form').submit(function(){
 			var msg=V.require_all(page,[
 	 	 			{sl:'#name',name:'姓名'},
 	 	 			{sl:'#phone',name:'手机'},
 	 	 			{sl:'#state',name:'状态'}
 	 	 	]);
 			if(msg!==""){
 				pop.open(msg);
 				return false;
 			}
		});
	})
	</script>

  </div>
</div>
@stop