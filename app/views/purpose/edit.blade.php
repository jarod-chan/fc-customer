@extends('layouts.mobile')

@section('content')
<div data-role="page" class="purpose_edit">
  <div data-role="content">

  {{ Form::open(array('url' => "customer/$customer_id/purpose/save",'data-ajax'=>'true')) }}
   @if($purpose->id)
   {{ Form::hidden('id',$purpose->id) }}
   @endif

    <ul data-role="listview" data-inset="true">
    	<li style="padding-left:1.5em" data-role="list-divider">意向信息</li>
    	<li>
    	<div class="fy_grid4">
		<p class='a'>客户级别</p>{{ Form::select('khjb',Purpose::enum('khjb'),$purpose->khjb,array('id'=>'khjb','data-native-menu'=>'true'))}}
		</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>意向强度</p>{{ Form::select('yxqd',Purpose::enum('yxqd'),$purpose->yxqd,array('id'=>'yxqd','data-native-menu'=>'true'))}}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>购房动机</p>{{ Form::select('gfdj',Purpose::enum('gfdj'),$purpose->gfdj,array("data-native-menu"=>"true"))}}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>住宅类型</p>{{ Form::select('zzlx',Purpose::enum('zzlx'),$purpose->zzlx,array("data-native-menu"=>"true"))}}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>户型类型</p>{{ Form::select('hxlx',Purpose::enum('hxlx'),$purpose->hxlx,array("data-native-menu"=>"true"))}}
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
    	<p class='a'>楼层</p>{{ Form::select('jzfg',Purpose::enum('jzfg'),$purpose->jzfg,array("data-native-menu"=>"true"))}}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>精装修</p>{{ Form::select('jzx',Purpose::enum('jzx'),$purpose->jzx,array("data-native-menu"=>"true"))}}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>优惠力度</p>{{ Form::select('yhld',Purpose::enum('yhld'),$purpose->yhld,array("data-native-menu"=>"true"))}}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>开盘时间</p>{{ Form::text('kpsj',$purpose->kpsj) }}
    	</div>
    	</li>
    	<li>
    	<div class="fy_grid4">
    	<p class='a'>学区房</p>{{ Form::select('xqf',H::prepend(Purpose::enum('xqf'),'学区房'),$purpose->xqf,array("data-native-menu"=>"true"))}}
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

  	@include('common.pop')

  	<script type="text/javascript">
	$(function(){
		var page= $(".purpose_edit").last();
		page.find('form:eq(0)').submit(function(){
 			var msg=V.require_all(page,[
 	 	 			{sl:'#khjb',name:'客户级别'},
 	 	 			{sl:'#yxqd',name:'意向强度'}
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