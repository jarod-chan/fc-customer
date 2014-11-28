@extends('layouts.boot')



@section('content')
<div class="container">

<h1>销售顾问-@if($counselor->id)编辑 @else新增@endif</h1>

@include('common.alert')

{{ Form::open(array('url' => 'counselor/save')) }}

  	{{ Form::hidden('id',$counselor->id) }}
	 <div class='row'>
	        <div class='col-sm-6'>
	            <div class='form-group'>
	                <label >用户名</label>
	                {{ Form::text('name',$counselor->name,array('class'=>'form-control')) }}
	            </div>
	        </div>
	        <div class='col-sm-6'>
	            <div class='form-group'>
	                <label >角色</label>
					{{ Form::select('role',Counselor::roleEnums(),$counselor->role,array('class'=>'form-control'))}}
	            </div>
	        </div>
	        <div class='col-sm-6'>
	            <div class='form-group'>
	                <label >微信id</label>
	                 {{ Form::text('openid',$counselor->openid,array('class'=>'form-control')) }}
	            </div>
	        </div>
	</div>


	{{ Form::submit('保存', array('class' => 'btn btn-sm btn-primary')) }}
	 <a class="btn btn-sm btn-default" href="{{ URL::to('counselor/list' ) }}">返回</a>
{{ Form::close() }}


</div>
@stop