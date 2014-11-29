@extends('layouts.boot')



@section('content')
<div class="container">

<h1>佣金比率</h1>

@include('common.alert')

{{ Form::open(array('url' => 'projectpct/save')) }}

  	{{ Form::hidden('id',$id) }}
	 <div class='row'>
        <div class='col-sm-6'>
            <div class='form-group'>
                <label >销售项目</label>
                <p>{{$name}}</p>
            </div>
        </div>
        <div class='col-sm-6'>
	            <div class='form-group'>
	                <label >佣金比率</label>
					 {{ Form::text('percent',H::trimz($percent),array('class'=>'form-control')) }}
	            </div>
	        </div>
     </div>


	{{ Form::submit('保存', array('class' => 'btn btn-sm btn-primary')) }}
	 <a class="btn btn-sm btn-default" href="{{ URL::to('projectpct/list' ) }}">返回</a>
{{ Form::close() }}


</div>
@stop