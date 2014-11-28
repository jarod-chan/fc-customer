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
/* 	.ui-content{
		padding: 0;
	}

	.ui-field-contain>label{
		text-align: right;
	}

	.ui-field-contain > label ~ [class*="ui-"], .ui-field-contain .ui-controlgroup-controls {
	    box-sizing: border-box;
	    float: left;
	}

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

	 */
	</style>
</head>
<body>
		@yield('content')
</body>
</html>