<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0,  maximum-scale=1" />

    {{HTML::script('js/jquery-1.11.1.min.js')}}
    {{HTML::script('js/myplug.js')}}
    {{HTML::script('js/common.js')}}
	@yield('head')
</head>
<body>
	@yield('content')
</body>
</html>