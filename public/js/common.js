 var V={
	require:function(jq,name){
		var msg='<p>'+name+'不能为空</p>';
		if(jq.length==0){
			return msg;
		}
		if($.trim(jq.val())==""){
			return msg;
		}
		return "";
	},
	phone:function(jq,name){
		var msg='<p>'+name+'不合法</p>';
		var reg=/^0?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/;
		if(!reg.test(jq.val())){
			return msg;
		}
		return "";
	},
 	require_all:function(page,arr){
 		var msg="";
 		for ( var i = 0; i < arr.length; i++) {
 			var jq=page.find(arr[i].sl);
 			var name=arr[i].name;
 			msg+=this.require(jq,name);
		}
 		return msg;
 	}

 };