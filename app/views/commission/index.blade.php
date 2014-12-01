@extends('layouts.mobile')

@section('content')
<div data-role="page" class="commission_index" data-url='{{ URL::to("commission?state=$state&key=$key") }}'  >
    <div data-role="content" >
    {{HTML::style('plug/scroll/scroll.css')}}
    {{HTML::script('plug/scroll/iScrollv4.2.5.js')}}
    <script type="text/javascript">changeTitle('佣金结算');</script>

	{{ Form::open(array('url' => 'commission','data-ajax'=>'true','method'=>'get')) }}
	<div class="ui-body ui-body-a" style="padding: 0px;margin: 0 -0.6em 0 -0.6em;background-color: #ededed;height: 5.5em;">
	<div data-role="navbar">
	    <ul>
	    @foreach(Dealrecord::stateEnums() as $state_key=>$state_value)
			 <li><a href="?state={{$state_key}}"  @if($state_key==$state)  class="ui-btn-active" @endif >{{$state_value}}</a></li>
	    @endforeach
	    </ul>
	</div>
	{{form::hidden('state',$state)}}
	<div class="fy-query">
	    <div class="c"  ><div>客户</div></div>
	    <div class="b" ><input type="text" name="key" id="key" value="{{$key}}"> <button class="fy-btn ui-btn  ui-corner-all"  >查询</button></div>
	</div>
	</div>
	{{ Form::close() }}

	<div id="wrapper" >
	<div id="scroller">
	<div id="item_div">
	@foreach($dealrecordList as $dealrecord)
	<?php
    	$room=$dealrecord->room();//d($room);
    ?>
	 <ul class="item" data-role="listview" data-inset="true">
	 	 <li><a href='{{ URL::to("commission/$dealrecord->id/deal?state=$state&key=$key") }}' >{{$dealrecord->id}}</a></li>

	 	 @if($room)
		<li>
		房间:{{$room['project_name'].$room['building_name'].H::nullStr($room,'buildunit_name').$room['roomName']}}
		</li>
		@endif

		<li>
		<div class="ui-grid-a">
		    <div class="ui-block-a">客户:{{$room['customer']}}</div>
		    <div class="ui-block-b">状态:{{$room['purchaseState']}}</div>
		</div>
		</li>
		<li>
		<div class="ui-grid-a">
		    <div class="ui-block-a">总价:{{$room['contractTotalAmount']}}</div>
		    <div class="ui-block-b">未付:{{$room['totalUnRevAmount']}}</div>
		</div>
		</li>
		<li>
		<div class="ui-grid-a">
		    <div class="ui-block-a">应结佣金:{{H::trimz($dealrecord->commission)}}</div>
		    <div class="ui-block-b">结算状态:{{$dealrecord->state()}}</div>
		</div>
		</li>
		<li>
		<div class="ui-grid-a">
		    <div class="ui-block-a">已结:{{H::trimz($dealrecord->inamt)}}</div>
		    <div class="ui-block-b">未结:{{H::trimz($dealrecord->leftamt)}}</div>
		</div>
		</li>

	 </ul>
	 @endforeach
	 </div>

	 <ul id="pullUp"><li class="pullUpIcon"></li><li class="pullUpLabel">上拉可以刷新...</li></ul>
	 </div>
	 </div>

	 <script type="text/javascript">
	 $(function(){
		 var page=$(".commission_index").last();
		 var wrapper=page.find("#wrapper");
		 var itemdiv=page.find("#item_div");
		 var winHeight=$(window).height();
		 wrapper.css({
			overflow: 'hidden',
			position: 'relative',
			height:winHeight-90
		});

		var minId={{$minId}};

		// 添加滚动条
        pullUpEl = page.find('#pullUp').get(0);
        pullUpOffset = pullUpEl.offsetHeight;

        if(minId<0){$(pullUpEl).hide()};

		var myscroll=new iScroll(wrapper.get(0),{
				hScroll        : false,
	         	vScroll        : true,
	         	hScrollbar     : false,
	         	vScrollbar     : false,
	         	fixedScrollbar : true,
	         	fadeScrollbar  : false,
	         	hideScrollbar  : true,
	         	bounce         : true,
	         	momentum       : true,
	         	lockDirection  : true,
	         	checkDOMChanges: true,
	         	onRefresh: function () {
		               	if (pullUpEl.className.match('loading')) {
		               		pullUpEl.className = '';
		               		pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉可以刷新...';
		               		if(minId<0){$(pullUpEl).hide()};
		               	}
		        },
         	    onScrollMove: function () {
					//console.log("y:"+this.y);
					//console.log('maxscrolly:'+this.maxScrollY);
					if(this.y>0) return;
        	    	if (this.y < (this.maxScrollY - 20) && !pullUpEl.className.match('flip')) {
          				pullUpEl.className = 'flip';
          				pullUpEl.querySelector('.pullUpLabel').innerHTML = '松开可以刷新...';
          				this.maxScrollY = this.maxScrollY;
          			} else if (this.y > (this.maxScrollY + 5) && pullUpEl.className.match('flip')) {
          				pullUpEl.className = '';
          				pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多...';
          				this.maxScrollY = pullUpOffset;
          			}
	              },
	         	onScrollEnd:function(){
	         		if (pullUpEl.className.match('flip')) {
	    				pullUpEl.className = 'loading';
	    				pullUpEl.querySelector('.pullUpLabel').innerHTML = '加载中...';
	    				if(minId<0){
	    					$(pullUpEl).hide();
	    					return;
			    		}
			    		var param={state:'{{$state}}',key:'{{$key}}',min_id:minId};
	    				$.get('{{URL::to("commission/query")}}',param,function(ret){
	    					minId=ret.minId;
							for(var i=0;i<ret.data.length;i++){
								var item=ret.data[i];
								var ul=$('<ul class="item" data-role="listview" data-inset="true"></li>');
								$('<li><a href="commission/'+item.dr_id+'/deal?state={{$state}}&key={{$key}}" >'+item.dr_id+'</a></li>').appendTo(ul);
								$('<li>房间:'+item.room+'</li>').appendTo(ul);
								$('<li><div class="ui-grid-a"><div class="ui-block-a">客户:'+item.customer+'</div><div class="ui-block-b">状态:'+item.purchaseState+'</div></div></li>').appendTo(ul);
								$('<li><div class="ui-grid-a"><div class="ui-block-a">总价:'+item.contractTotalAmount+'</div><div class="ui-block-b">未付:'+item.totalUnRevAmount+'</div></div></li>').appendTo(ul);
								$('<li><div class="ui-grid-a"><div class="ui-block-a">应结佣金:'+item.commission+'</div><div class="ui-block-b">结算状态:'+item.dr_state+'</div></div></li>').appendTo(ul);
								$('<li><div class="ui-grid-a"><div class="ui-block-a">已结:'+item.dr_inamt+'</div><div class="ui-block-b">未结:'+item.dr_leftamt+'</div></div></li>').appendTo(ul);
								itemdiv.append(ul).trigger("create");
								ul.listview("refresh");
							}
							myscroll.refresh();
							return;
	    				});
	    			}
			    }
		});
	 })

	 </script>

	</div>
</div>
@stop
