@extends('layouts.mobile')

@section('content')
<div data-role="page">
  <div data-role="content">

  {{ Form::open(array('url' => 'customer/save', 'files'=>true,'data-ajax'=>'true')) }}

    <ul data-role="listview" data-inset="true" >
    	<li data-role="list-divider">客户信息</li>
    	<li>
		{{ Form::text('name','',array('placeholder'=>'姓名')) }}
		</li>
		<li>
		{{ Form::text('phone','',array('placeholder'=>'手机号')) }}
		</li>
		<li class="ui-field-contain">
			{{ Form::select('counselor_id',H::prepend($counselorSet,'销售顾问'),$counselor->id,array('data-native-menu'=>'false'))}}
		</li>
		<li class="ui-field-contain">
			{{ Form::select('state',H::prepend($stateSet,'状态'),'',array('data-native-menu'=>'false'))}}
		</li>
		<li data-role="collapsible" data-iconpos="right" data-inset="false">
			 <h2>更多</h2>
				<ul data-role="listview">
				<li>
				{{ Form::text('qq','',array('placeholder'=>'QQ')) }}
				</li>
				<li>
				{{ Form::text('email','',array('placeholder'=>'邮箱')) }}
				</li>
				<li>
				{{ Form::text('weixin','',array('placeholder'=>'微信')) }}
				</li>
				<li>
				{{ Form::text('from','',array('placeholder'=>'来源')) }}
				</li>
				<li>
				{{ Form::text('way','',array('placeholder'=>'途径')) }}
				</li>
				<li class="ui-field-contain">
					登记人:{{$counselor->name}}
				</li>
			 </ul>
		 </li>
    </ul>

    <p>{{ Form::submit('保存') }}</p>

  	{{ Form::close() }}

  </div>
</div>
@stop