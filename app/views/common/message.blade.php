@extends('layouts.mobile')

@section('content')
<div data-role="page">
	<div data-role="content">
		<div class="ui-corner-all custom-corners">
			<div class="ui-bar ui-bar-a">
				<h3>系统信息</h3>
			</div>
			<div class="ui-body ui-body-a">
				@if (Session::has('message'))
				<p>{{ Session::get('message') }}</p>
				@endif
			</div>
		</div>
	</div>
</div>
@stop