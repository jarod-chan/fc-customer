@extends('layouts.mobile')

@section('content')
<div data-role="page">
  <div data-role="content">

  {{ Form::open(array('url' => "customer/$customer_id/purpose/save",'data-ajax'=>'true')) }}
   @if($purpose->id)
   {{ Form::hidden('id',$purpose->id) }}
   @endif

    <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">意向信息</li>
    	<li>
    	{{ Form::text('khjb',$purpose->khjb,array('placeholder'=>'客户级别')) }}
    	</li>
    	<li>
    	{{ Form::text('yxqd',$purpose->yxqd,array('placeholder'=>'意向强度')) }}
    	</li>
    	<li>
    	{{ Form::text('gfdj',$purpose->gfdj,array('placeholder'=>'购房动机')) }}
    	</li>
    	<li>
    	{{ Form::text('zzlx',$purpose->zzlx,array('placeholder'=>'住宅类型')) }}
    	</li>
    	<li>
    	{{ Form::text('hxlx',$purpose->hxlx,array('placeholder'=>'户型类型')) }}
    	</li>
    	<li>
    	{{ Form::text('mj',$purpose->mj,array('placeholder'=>'面积')) }}
    	</li>
    	<li>
    	{{ Form::text('dj',$purpose->dj,array('placeholder'=>'单价')) }}
    	</li>
    	<li>
    	{{ Form::text('zj',$purpose->zj,array('placeholder'=>'总价')) }}
    	</li>
    	<li>
    	{{ Form::text('dd',$purpose->dd,array('placeholder'=>'地段')) }}
    	</li>
    	<li>
    	{{ Form::text('jzfg',$purpose->jzfg,array('placeholder'=>'建筑风格')) }}
    	</li>
    	<li>
    	{{ Form::text('jzx',$purpose->jzx,array('placeholder'=>'精装修')) }}
    	</li>
    	<li>
    	{{ Form::text('yhld',$purpose->yhld,array('placeholder'=>'优惠力度')) }}
    	</li>
    	<li>
    	{{ Form::text('kpsj',$purpose->kpsj,array('placeholder'=>'开盘时间')) }}
    	</li>
    	<li>
    	{{ Form::text('xqf',$purpose->xqf,array('placeholder'=>'学区房')) }}
    	</li>
    </ul>

    <p>{{ Form::submit('保存') }}</p>

  	{{ Form::close() }}

  </div>
</div>
@stop