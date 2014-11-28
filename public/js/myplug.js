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

/**
 * 左补齐字符串
 *
 * @param nSize
 *            要补齐的长度
 * @param ch
 *            要补齐的字符
 * @return
 */
String.prototype.padLeft = function(nSize, ch)
{
    var len = 0;
    var s = this ? this : "";
    ch = ch ? ch : '0';// 默认补0

    len = s.length;
    while (len < nSize)
    {
        s = ch + s;
        len++;
    }
    return s;
}

/**
 * 右补齐字符串
 *
 * @param nSize
 *            要补齐的长度
 * @param ch
 *            要补齐的字符
 * @return
 */
String.prototype.padRight = function(nSize, ch)
{
    var len = 0;
    var s = this ? this : "";
    ch = ch ? ch : '0';// 默认补0

    len = s.length;
    while (len < nSize)
    {
        s = s + ch;
        len++;
    }
    return s;
}
/**
 * 左移小数点位置（用于数学计算，相当于除以Math.pow(10,scale)）
 *
 * @param scale
 *            要移位的刻度
 * @return
 */
String.prototype.movePointLeft = function(scale)
{
    var s, s1, s2, ch, ps, sign;
    ch = '.';
    sign = '';
    s = this ? this : "";

    if (scale <= 0) return s;
    ps = s.split('.');
    s1 = ps[0] ? ps[0] : "";
    s2 = ps[1] ? ps[1] : "";
    if (s1.slice(0, 1) == '-')
    {
        s1 = s1.slice(1);
        sign = '-';
    }
    if (s1.length <= scale)
    {
        ch = "0.";
        s1 = s1.padLeft(scale);
    }
    return sign + s1.slice(0, -scale) + ch + s1.slice(-scale) + s2;
}
/**
 * 右移小数点位置（用于数学计算，相当于乘以Math.pow(10,scale)）
 *
 * @param scale
 *            要移位的刻度
 * @return
 */
String.prototype.movePointRight = function(scale)
{
    var s, s1, s2, ch, ps;
    ch = '.';
    s = this ? this : "";

    if (scale <= 0) return s;
    ps = s.split('.');
    s1 = ps[0] ? ps[0] : "";
    s2 = ps[1] ? ps[1] : "";
    if (s2.length <= scale)
    {
        ch = '';
        s2 = s2.padRight(scale);
    }
    return s1 + s2.slice(0, scale) + ch + s2.slice(scale, s2.length);
}
/**
 * 移动小数点位置（用于数学计算，相当于（乘以/除以）Math.pow(10,scale)）
 *
 * @param scale
 *            要移位的刻度（正数表示向右移；负数表示向左移动；0返回原值）
 * @return
 */
String.prototype.movePoint = function(scale)
{
    if (scale >= 0)
        return this.movePointRight(scale);
    else
        return this.movePointLeft(-scale);
}

var calc = {
	add:function(arg1,arg2){
		  var r1,r2,m;
		  try{r1=arg1.toString().split(".")[1].length}catch(e){r1=0}
		  try{r2=arg2.toString().split(".")[1].length}catch(e){r2=0}
		  m=Math.pow(10,Math.max(r1,r2))
		  return (arg1*m+arg2*m)/m
	 },
	 sub:function(arg1,arg2){
		 var r1,r2,m,n;
		 try{r1=arg1.toString().split(".")[1].length}catch(e){r1=0}
		 try{r2=arg2.toString().split(".")[1].length}catch(e){r2=0}
		 m=Math.pow(10,Math.max(r1,r2));
		 //动态控制精度长度
		 n=(r1>=r2)?r1:r2;
		 return ((arg1*m-arg2*m)/m).toFixed(n);
	 },
	 mul:function(arg1,arg2)
	 {
		  var m=0,s1=arg1.toString(),s2=arg2.toString();
		  try{m+=s1.split(".")[1].length}catch(e){}
		  try{m+=s2.split(".")[1].length}catch(e){}
		  var ret=Number(s1.replace(".",""))*Number(s2.replace(".",""));
		  return ret.toString().movePoint(-m);
	 },
	 div:function div(arg1,arg2){
		var t1=0,t2=0,r1,r2;
		try{t1=arg1.toString().split(".")[1].length}catch(e){}
		try{t2=arg2.toString().split(".")[1].length}catch(e){}
		with(Math){
			r1=Number(arg1.toString().replace(".",""))
			r2=Number(arg2.toString().replace(".",""))
			return (r1/r2)*pow(10,t2-t1);
		}
	}
}

function Trim(objStr){
	return  $.trim(objStr);
}

//四舍五入，保留0
function hold(x,n)
{
        var N = Math.pow(10,n);
        return calc.div(Math.round(x * N),N).toFixed(n);
}

/*
IsFloat(string,string,int or string)测试字符串,+ or - or empty,empty or 0)
功能：判断是否为浮点数、正浮点数、负浮点数、正浮点数+0、负浮点数+0
*/
function isF(objStr,sign,zero)
{
    var reg;
    var bolzero;

    if(Trim(objStr)==""){
  	  return false;
    }else{
  	  objStr=Trim(objStr.toString());
    }

    if((sign==null)||(Trim(sign)==""))
    {
  	  sign="+-";
    }

    if((zero==null)||(Trim(zero)==""))
    {
  	  bolzero=false;
    }else{
  	  zero=zero.toString();
  	  if(zero=="0"){
  	  	bolzero=true;
  	  }else{
  	  	alert("检查是否包含0参数，只可为(空、0)");
  	  }
    }

    switch(sign)
    {
  	  case "+-":
  	  	//浮点数
  	  	reg=/^((-?|\+?)\d+)(\.\d+)?$/;
  	  	break;
  	  case "+":
  	  	if(!bolzero){
  	  	    //正浮点数
  	  	    reg=/^\+?(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$/;
  	  	}
  	  	else{
  	  	    //正浮点数+0
  	  	    reg=/^\+?\d+(\.\d+)?$/;
  	  	}
  	  	break;
  	  case "-":
  	  	if(!bolzero){
  	  	    //负浮点数
  	  	   reg=/^-(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$/;
  	  	}
  	  	else{
  	  	    //负浮点数+0
  	  	    reg=/^((-\d+(\.\d+)?)|(0+(\.0+)?))$/;
  	  	}
  	  	break;
  	  default:
  	  	alert("检查符号参数，只可为(空、+、-)");
  	  	return false;
  	  	break;
    }

    var r=objStr.match(reg);
    if(r==null){
  	  return false;
    }else{
  	  return true;
    }
}

