<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0,  maximum-scale=1" />
	<title id="fy_title"></title>
	{{HTML::style('css/jquery.mobile-1.4.3.min.css')}}
	{{HTML::style('views/ext-jqm.css')}}
    {{HTML::script('js/jquery-1.11.1.min.js')}}
    {{HTML::script('js/common.js')}}
    {{HTML::script('js/jquery.mobile-1.4.3.min.js')}}
    {{HTML::script('js/myplug.js')}}  
    
	@yield('head')
</head>
<body>
		@yield('content')
</body>
</html>