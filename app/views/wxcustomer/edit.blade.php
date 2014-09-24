@extends('layouts.mobile')

@section('content')
<div data-role="page">
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

  {{ Form::open(array('url' => 'wx/'.$crid.'/customer/save', 'files'=>true,'data-ajax'=>'false')) }}

    <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">客户信息</li>
    	<li>
		{{ Form::text('name',$customer->name,array('placeholder'=>'姓名')) }}
		</li>
		<li>
		{{ Form::text('phone',$customer->phone,array('placeholder'=>'手机号')) }}
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
				{{ Form::text('qq',$customer->qq,array('placeholder'=>'QQ')) }}
				</li>
				<li>
				{{ Form::text('email',$customer->email,array('placeholder'=>'邮箱')) }}
				</li>
				<li>
				{{ Form::text('weixin',$customer->weixin,array('placeholder'=>'微信')) }}
				</li>
				<li>
				{{ Form::text('from',$customer->from,array('placeholder'=>'来源')) }}
				</li>
				<li>
				{{ Form::text('way',$customer->way,array('placeholder'=>'途径')) }}
				</li>
				<li class="ui-field-contain">
					登记人:{{$customer->register->name}}
				</li>
		    </ul>
		  </li>
    </ul>

    <ul data-role="listview" data-inset="true">
	    <li><a href="#">意向信息</a></li>
	    <li><a href="#">意向房源</a></li>
	    <li><a href="#">跟进记录</a></li>
	    <li><a href="#">成交记录</a></li>
	</ul>

    <p>{{ Form::submit('提交') }}</p>

  	{{ Form::close() }}

  </div>
</div>
@stop