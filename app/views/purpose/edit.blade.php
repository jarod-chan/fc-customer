@extends('layouts.mobile')

@section('content')
<div data-role="page">
  <div data-role="content">

  {{ Form::open(array('url' => "customer/$customer_id/purpose/save",'data-ajax'=>'true')) }}
   @if($purpose->id)
   {{ Form::hidden('id',$purpose->id) }}
   @endif

    <ul data-role="listview" data-inset="true">
    	<li style="padding-left:1.5em" data-role="list-divider">意向信息</li>
    	<li>
    	<div class="fy_grid4">
		<p class='a'>客户级别</p>{{ Form::select('khjb',H::prepend(Purpose::enum('khjb'),'客户级别'),$purpose->khjb,array('data-native-menu'=>'false'))}}
		</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>意向强度</p>{{ Form::select('yxqd',H::prepend(Purpose::enum('yxqd'),'意向强度'),$purpose->yxqd,array('data-native-menu'=>'false'))}}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>购房动机</p>{{ Form::select('gfdj',H::prepend(Purpose::enum('gfdj'),'购房动机'),$purpose->gfdj,array('data-native-menu'=>'false'))}}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>住宅类型</p>{{ Form::select('zzlx',H::prepend(Purpose::enum('zzlx'),'住宅类型'),$purpose->zzlx,array('data-native-menu'=>'false'))}}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>户型类型</p>{{ Form::select('hxlx',H::prepend(Purpose::enum('hxlx'),'户型类型'),$purpose->hxlx,array('data-native-menu'=>'false'))}}
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
    	<p class='a'>建筑风格</p>{{ Form::select('jzfg',H::prepend(Purpose::enum('jzfg'),'建筑风格'),$purpose->jzfg,array('data-native-menu'=>'false'))}}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>精装修</p>{{ Form::select('jzx',H::prepend(Purpose::enum('jzx'),'精装修'),$purpose->jzx,array('data-native-menu'=>'false'))}}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>优惠力度</p>{{ Form::select('yhld',H::prepend(Purpose::enum('yhld'),'优惠力度'),$purpose->yhld,array('data-native-menu'=>'false'))}}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>开盘时间</p><input type="date"  name="kpsj" value="{{$purpose->kpsj}}" >
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>学区房</p>{{ Form::select('xqf',H::prepend(Purpose::enum('xqf'),'学区房'),$purpose->xqf,array('data-native-menu'=>'false'))}}
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