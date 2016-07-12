 
var PG={
	indx:0,
	offset:-1,//最小页面id，分页用
	state:"",//默认页面状态
	type:"",//查询姓名或电话
	key:"",//查询关键词
	url:null,
	setAll:function(type,key,offset){
		PG.offset=offset;
		PG.type=type;
		PG.key=key;
		return PG;
	},
	finish:function(){
		PG.indx++;
	},
	setState:function(state){
		PG.state=state;
		return PG;
	},
	setUrl:function(url){
		if(!PG.url){
			PG.url=url;
		}
		return PG;
	}
}


$(document).on("pageinit","div.customer_index", function (event) {
	 var page=$(".ui-page").last();

	 //设置下拉刷新区域
	 var wrapper=page.find("#wrapper");
	 var itemdiv=page.find("#item_div");
	 var winHeight=$(window).height();
	 wrapper.css({
		overflow: 'hidden',
		position: 'relative',
		height:winHeight-55
	});


	// 添加加载提示
	pullUpEl = page.find('#pullUp').get(0);
	pullUpOffset = pullUpEl.offsetHeight;

	if(PG.offset<0){$(pullUpEl).hide()};

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
	               	}
	        },
	 	    onScrollMove: function () {
	 	 		// console.log("y:"+this.y);
				// console.log('maxscrolly:'+this.maxScrollY);
				if(this.y>0) return; //下拉不执行任何操作
		    	if (this.y < (this.maxScrollY - 50) && !pullUpEl.className.match('flip')) {//上拉到50改变样式
	  				pullUpEl.className = 'flip';
	  				pullUpEl.querySelector('.pullUpLabel').innerHTML = '松开开始加载数据';
	  				this.maxScrollY = this.maxScrollY;
	  			} else if (this.y > (this.maxScrollY - 40) && pullUpEl.className.match('flip')) {//恢复大到上拉40 不加载数据
	  				pullUpEl.className = '';
	  				pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多数据';
	  				this.maxScrollY = this.maxScrollY;
	  			}
	          },
	     	onScrollEnd:function(){ 
	     		if (isloading==false&&PG.offset>0 && pullUpEl.className.match('flip')) {
					pullUpEl.className = 'loading';
					pullUpEl.querySelector('.pullUpLabel').innerHTML = '加载中...';
					
		    		var param={type:PG.type,key:PG.key, offset:PG.offset}; //alert("scrollend:"+param.offset);
					$.get(PG.url,param,function(ret){
						PG.offset=ret.offset;
						if(PG.offset<0){$(pullUpEl).hide();}
						for(var i=0;i<ret.data.length;i++){
							var item=ret.data[i];
							var ul=$('<ul class="item" data-role="listview" data-inset="true"></ul>');
							var link=$('<a href="'+item.id+'/edit" ></a>');
							$('<h2>客户：'+item.name+item.remark+'</h2>').appendTo(link);
							$('<p>更新时间：'+item.update_at+'</p>').appendTo(link);
							$('<li></li>').append(link).appendTo(ul);

							itemdiv.append(ul).trigger("create");
							ul.listview("refresh");
						}
						myscroll.refresh();
						return;
					});
				}
		    }
	});

	setTimeout(function(){myscroll.refresh();},0);
	
	var isloading=false;

	page.on("click","#btn_query",function(event){
		if(isloading){return;}

	 	var type=page.find("#type").val();
	 	var key=page.find("#key").val();


		$.mobile.loading("show");
		isloading=true;
		PG.setAll(type,key,-1);	
		itemdiv.empty();
		/*透明来隐藏下拉条，加载数据完成以后显示，如果用hide，则会影响iscroll长度*/
		$(pullUpEl).css({opacity:0});
		page.trigger("refresh");/*请勿删除，会造成部分数据架子后不能显示的问题*/
		myscroll.refresh("refresh");

		var param={type:PG.type,key:PG.key, offset:PG.offset};
		$.get(PG.url,param,function(ret){
			PG.offset=ret.offset; 
			for(var i=0;i<ret.data.length;i++){
				var item=ret.data[i];
				var ul=$('<ul class="item" data-role="listview" data-inset="true"></ul>');
				var link=$('<a href="'+item.id+'/edit" ></a>');
				$('<h2>客户：'+item.name+item.remark+'</h2>').appendTo(link);
				$('<p>更新时间：'+item.update_at+'</p>').appendTo(link);
				$('<li></li>').append(link).appendTo(ul);

				itemdiv.append(ul).trigger("create");
				ul.listview("refresh");
			}
			if(PG.offset<0){$(pullUpEl).hide()}else{$(pullUpEl).show()};	
			myscroll.refresh();
			myscroll.scrollToPage(0,0,0);//进度条置为0,当只有一条数据时会出现先下拉再上浮，无法解决

			if(PG.offset>0){$(pullUpEl).css({opacity:1})};
			$.mobile.loading("hide");
			isloading=false;
			
		});

	 });

	PG.finish();
	console.info(PG);
}); 

