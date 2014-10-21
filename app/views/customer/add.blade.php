@extends('layouts.mobile')

@section('content')
<div data-role="page">
  <div data-role="content">
  <script type="text/javascript">changeTitle('客户信息');</script>

  {{ Form::open(array('url' => 'customer/save','data-ajax'=>'true')) }}

    <ul data-role="listview" data-inset="true" >
    	<li data-role="list-divider">客户信息</li>
    	<li>
    	<div class="fy_grid">
	         <p class='a'>姓名</p>{{ Form::text('name','') }}
	    </div>
	    </li>
		<li>
		<div class="fy_grid">
			<p class='a'>手机</p>{{ Form::text('phone','') }}
		</div>
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
				<p class='a'>来源</p>{{ Form::text('from','') }}
				</div>
				</li>
				<li>
				<div class="fy_grid">
				<p class='a'>途径</p>{{ Form::text('way','') }}
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

  </div>
</div>
@stop