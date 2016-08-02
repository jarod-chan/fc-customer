<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <!-- Bootstrap -->
    {{HTML::style('css/bootstrap.min.css')}}
    {{HTML::style('css/bootstrap-theme.min.css')}}
    {{HTML::script('js/jquery-1.11.1.min.js')}}
    {{HTML::script('js/bootstrap.min.js')}}
    {{HTML::script('js/myplug.js')}}

    <style type="text/css">
	body { padding-top: 50px; }
   </style>

	@yield('import_head')


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   <!-- Static navbar -->
    <div class="navbar navbar-default navbar-static-top navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">客户跟踪系统后台</a>
        </div>

        <div class="navbar-collapse collapse">
        @if (C::isLogin())
        <ul class="nav navbar-nav">
	            <li class="dropdown">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown">系统配置<span class="caret"></span></a>
	              <ul class="dropdown-menu" role="menu">
	                <li><a href="{{ URL::to('counselor/list') }}">销售顾问</a></li>
	                <li><a href="{{ URL::to('syenum/list') }}">配置选项</a></li>
	                <li><a href="{{ URL::to('projectpct/list') }}">佣金比率</a></li>
                  <li><a href="{{ URL::to('projectosh/list') }}">项目房源</a></li>
	                <li><a href="{{ URL::to('sysparam/list') }}">全局参数</a></li>
	              </ul>
	            </li>
		 </ul>
  		@endif

          @if (C::isLogin())
          <div  class="navbar-collapse collapse navbar-right">
          <button id="btn_logout" class="btn btn-sm btn-default navbar-btn">退出</button>
         </div>
		  <p class="navbar-text navbar-right">用户：管理员&nbsp;&nbsp;</p>
		  @endif
        </div><!--/.nav-collapse -->
      </div>
    </div>

  	@yield('content')


  		  <script type="text/javascript">
            $(function () {
                $("#btn_logout").click(function(){
                	$('<form/>',{action:"{{ URL::to('logout') }}",method:'post'})
           			.appendTo($("body"))
           			.submit();
                })
            })
        </script>
  </body>
</html>
