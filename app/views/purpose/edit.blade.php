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
    	<div class="fy_grid4">
		<p class='a'>客户级别</p>{{ Form::text('khjb',$purpose->khjb) }}
		</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>意向强度</p>{{ Form::text('yxqd',$purpose->yxqd) }}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>购房动机</p>{{ Form::text('gfdj',$purpose->gfdj) }}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>住宅类型</p>{{ Form::text('zzlx',$purpose->zzlx) }}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>户型类型</p>{{ Form::text('hxlx',$purpose->hxlx) }}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>面积</p>{{ Form::text('mj',$purpose->mj) }}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>单价</p>{{ Form::text('dj',$purpose->dj) }}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>总价</p>{{ Form::text('zj',$purpose->zj) }}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>地段</p>{{ Form::text('dd',$purpose->dd) }}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>建筑风格</p>{{ Form::text('jzfg',$purpose->jzfg) }}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>精装修</p>{{ Form::text('jzx',$purpose->jzx) }}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>优惠力度</p>{{ Form::text('yhld',$purpose->yhld) }}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>开盘时间</p>{{ Form::text('kpsj',$purpose->kpsj) }}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>学区房</p>{{ Form::text('xqf',$purpose->xqf) }}
    	</div>
    	</li>
    </ul>

	 <p><button class="fy-btn ui-btn  ui-shadow  ui-corner-all"  >保存</button></p>

  	{{ Form::close() }}

  	 @if($purpose->id)
  	{{ Form::open(array('url' => "customer/$customer_id/purpose/$purpose->id/delete",'data-ajax'=>'true')) }}
  	 <p><button class="fy-btn ui-btn  ui-shadow  ui-corner-all"  >删除</button></p>
	{{ Form::close() }}
  	@endif

  </div>
</div>
@stop