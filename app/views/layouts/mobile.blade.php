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
	.controlgroup-textinput{
	    padding-top:.22em;
	    padding-bottom:.22em;
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
	</style>
</head>
<body>
		@yield('content')
</body>
</html>