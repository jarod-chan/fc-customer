@extends('layouts.boot')



@section('content')
<div class="container">

<h1>全局参数</h1>

@include('common.alert')

{{ Form::open(array('url' => 'sysparam/save')) }}

  	{{ Form::hidden('key',$sysparam->key) }}
	 <div class='row'>
        <div class='col-sm-6'>
            <div class='form-group'>
                <label >参数名称</label>
                <p>{{$sysparam->name}}</p>
            </div>
        </div>
        <div class='col-sm-6'>
	            <div class='form-group'>
	                <label >参数值</label>
					 {{ Form::text('value',$sysparam->value,array('class'=>'form-control')) }}
	            </div>
	        </div>
     </div>


	{{ Form::submit('保存', array('class' => 'btn btn-sm btn-primary')) }}
	 <a class="btn btn-sm btn-default" href="{{ URL::to('sysparam/list' ) }}">返回</a>
{{ Form::close() }}


</div>
@stop