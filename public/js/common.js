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