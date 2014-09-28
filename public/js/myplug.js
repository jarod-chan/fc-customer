//jquery 自定义插件 把数组按spring格式提交
(function($) {
	$.fn.formatName = function() {
		var _options = {
    		match : "-"
        };
		var re=new RegExp(_options.match,"g");

        this.init = function () {

        	var list=this;
        	list.each(function(index){
        		$(this).find('input[name*='+_options.match+'],select[name*='+_options.match+'],textarea[name*='+_options.match+']').each(function(){
       				$(this).attr("name",$(this).attr("name").replace(re,index));
        		});
        	});
        }
        this.init();
	};
})(jQuery);
