 
var PG={
	indx:0,
	minId:-1,//最小页面id，分页用
	state:"no",//默认页面状态
	key:"",//查询关键词
	url:null,
	setAll:function(minId,state,key){
		PG.minId=minId;
		PG.state=state;
		PG.key=key;
		return PG;
	},
	finish:function(){
		PG.indx++;
	},
	setUrl:function(url){
		if(!PG.url){
			PG.url=url;
		}
		return PG;
	}
}


$(document).on("pageinit","div.commission_index", function (event) {
	 var page=$(".ui-page").last();

	 page.find("#state_"+PG.state).addClass("ui-btn-active");


	 //设置下拉刷新区域
	 var wrapper=page.find("#wrapper");
	 var itemdiv=page.find("#item_div");
	 var winHeight=$(window).height();
	 wrapper.css({
		overflow: 'hidden',
		position: 'relative',
		height:winHeight-90
	});


	// 添加滚动条
	pullUpEl = page.find('#pullUp').get(0);
	pullUpOffset = pullUpEl.offsetHeight;

	if(PG.minId<0){$(pullUpEl).hide()};

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
	     	checkDOMChanges: false,
	     	onRefresh: function () { console.log("onRefreshScroll");
	               	if (pullUpEl.className.match('loading')) {
	               		pullUpEl.className = '';
	               		pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多数据';
	               		if(PG.minId<0){$(pullUpEl).hide()};
	               	}
	        },
	 	    onScrollMove: function () {
				//console.log("y:"+this.y);
				//console.log('maxscrolly:'+this.maxScrollY);
				if(this.y>0) return;
		    	if (this.y < (this.maxScrollY - 50) && !pullUpEl.className.match('flip')) {
	  				pullUpEl.className = 'flip';
	  				pullUpEl.querySelector('.pullUpLabel').innerHTML = '松开开始加载数据';
	  				this.maxScrollY = this.maxScrollY;
	  			} else if (this.y > (this.maxScrollY + 5) && pullUpEl.className.match('flip')) {
	  				pullUpEl.className = '';
	  				pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多数据';
	  				this.maxScrollY = pullUpOffset;
	  			}
	          },
	     	onScrollEnd:function(){
	     		if (pullUpEl.className.match('flip')) {
					pullUpEl.className = 'loading';
					pullUpEl.querySelector('.pullUpLabel').innerHTML = '加载中...';
					if(PG.minId<0){
						$(pullUpEl).hide();
						return;
		    		}
		    		var param={state:PG.state, key:PG.key, min_id:PG.minId};
		    		console.log(PG.url);
					$.get(PG.url,param,function(ret){
						PG.minId=ret.minId;
						for(var i=0;i<ret.data.length;i++){
							var item=ret.data[i];
							var ul=$('<ul class="item" data-role="listview" data-inset="true"></ul>');
							$('<li><a href="commission/'+item.dr_id+'/deal?state='+PG.state+'&key='+PG.key+'" >'+item.dr_id+'</a></li>').appendTo(ul);
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


	setTimeout(function(){ myscroll.refresh();},1000);
	PG.finish();
	//console.info(PG);

}); 

