<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0,  maximum-scale=1" />
	{{HTML::style('css/jquery.mobile-1.4.3.min.css')}}
    {{HTML::script('js/jquery-1.11.1.min.js')}}
    {{HTML::script('js/jquery.mobile-1.4.3.min.js')}}
    {{HTML::script('js/myplug.js')}}


    <style type="text/css">
 	/*页面边距*/
	.ui-content{
		padding: 0.4em;
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

	.ui-listview > .fy_sm >.ui-btn {
	    padding: 0.2em 0.2em;
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
	}

	/*字体设置*/
	.ui-listview > .ui-li-divider {
	    font-size: 1em;
	}

	</style>
</head>
<body>
		@yield('content')
</body>
</html>