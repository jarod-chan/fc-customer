<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0,  maximum-scale=1" />
	<title id="fy_title"></title>
	{{HTML::style('css/jquery.mobile-1.4.3.min.css')}}
    {{HTML::script('js/jquery-1.11.1.min.js')}}
    {{HTML::script('js/jquery.mobile-1.4.3.min.js')}}
    {{HTML::script('js/myplug.js')}}
    {{HTML::script('js/common.js')}}

    <script type="text/javascript">
	function changePage(url){
		$.mobile.changePage(url);
	}
	function changeTitle(title){
		$("#fy_title").html(title);
	}
    </script>

    <style type="text/css">
 	/*页面边距*/
	.ui-content{
		padding: 0 0.6em 0 0.6em;
	}


	/**/
	.ui-li-static.ui-collapsible > .ui-collapsible-heading {
	    margin: 0;
	}
	.ui-li-static.ui-collapsible {
	    padding: 0;
	}
	.ui-li-static.ui-collapsible > .ui-collapsible-heading > .ui-btn {
	    border-top-width: 0;
	}
	.ui-li-static.ui-collapsible > .ui-collapsible-heading.ui-collapsible-heading-collapsed > .ui-btn,
	.ui-li-static.ui-collapsible > .ui-collapsible-content {
	    border-bottom-width: 0;
	}

	/*重新定义间距*/
	.ui-listview > .ui-li-static {
	    padding: 0.5em 0.6em;
	}

	/*阴影效果*/
	.ui-shadow,.ui-shadow-inset{
	 text-shadow: none;
	 box-shadow: none;
	 -webkit-box-shadow: none;
	}

	.ui-input-text{
		margin:0px;
		border-width: 0px;
	}

	.ui-input-text input{
		background-color:#F6F6F6;
	}

	.fy_grid4 textarea{
		background-color:#F6F6F6;
	}

	/*自定义布局*/
	.fy_grid>.a{
		float:left;
		width:3.0em;
		padding-left:0.8em;
		font-size: 1em;
		margin: 0.4em 0;
	}
	.fy_grid>div{
		margin-left:3.8em;
	}

	.fy_grid>.c{
		float:left;
		padding-left:0.8em;
		font-size: 1em;
		margin: 0.4em 0;
	}

	/*描述文字为四个字时*/
	.fy_grid4>.a{
		float:left;
		width:4em;
		padding-left:0.8em;
		font-size: 1em;
		margin: 0.4em 0;
	}
	.fy_grid4>div{
		margin-left:5em;
	}
	.fy_grid4>.c{
		float:left;
		padding-left:0.8em;
		font-size: 1em;
		margin: 0.4em 0;
	}
	/*textarea 输入框背景颜色*/
	.ui-page-theme-a .fy_grid4 textarea{
		background-color:#F6F6F6;
	}

	/* 按钮 */
	.ui-page-theme-a .fy-btn,
	.ui-page-theme-a .fy-btn:visited {
		background-color: #3388cc /*{a-bup-background-color}*/;
		text-shadow: none;
		color:white;
	}

	.ui-body-a,
	.ui-page-theme-a .ui-body-inherit,
	html .ui-bar-a .ui-body-inherit,
	html .ui-body-a .ui-body-inherit,
	html body .ui-group-theme-a .ui-body-inherit,
	html .ui-panel-page-container-a {
		border-top-color:#f0f0f0;
	}

	/*select 无边框*/
	.ui-select .ui-btn {
		border: none;
		padding-top: 0.5em;
		padding-bottom: 0.5em;
	}

	.ui-select {
	    margin-bottom: 0.2em;
	    margin-top: 0.2em;
	}

	/*字体设置*/
	.ui-listview > .ui-li-divider {
	    font-size: 1em;
	}

	.pl-02em{
		padding-left: 0.2em;
	}
	.pt-07em{
		padding-top: 0.7em;
	}
	.pt-02em{
		padding-top: 0.2em;
	}

	/*查询行*/
	.fy-query>.a{
		float:left;
		width: 5.5em;
	}
	.fy-query>.a>.ui-select{
		margin-top: 0.3em;
		margin-bottom: 0em;
	}
	.fy-query>.a>.ui-select>.ui-btn{
		background-color: #f0f0f0;
		padding-left: 5px;
	}

	.fy-query>.b>div>input{
		height: 2.56em;
	}
	.fy-query>.b{
		padding-top: 0.3em;
		margin-left: 5.7em;
		margin-right: 4.5em;
	}

	.fy-query>.b>.fy-btn{
		float:right;height:2.6em;width: 4em;margin-top:-2.6em;margin-right: -4.3em;padding: 0px;
	}

	.fy-query>.c{
		float:left;
		width: 5.5em;
	}
	.fy-query>.c>div{
		color:#333;
		margin-top:0.3em;
		margin-left:0.5em;
		padding:8px 40px 8px 5px;
		font-weight: 700;
	}

	/* 去掉边框阴影 */
    .ui-page-theme-a .ui-btn:focus, html .ui-bar-a .ui-btn:focus, html .ui-body-a .ui-btn:focus, html body .ui-group-theme-a .ui-btn:focus, html head + body .ui-btn.ui-btn-a:focus, .ui-page-theme-a .ui-focus, html .ui-bar-a .ui-focus, html .ui-body-a .ui-focus, html body .ui-group-theme-a .ui-focus, html head + body .ui-btn-a.ui-focus, html head + body .ui-body-a.ui-focus {
	    box-shadow: 0 0 0 0 #FFF;
	}

	</style>

	@yield('head')
</head>
<body>
		@yield('content')
</body>
</html>