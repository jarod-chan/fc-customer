@extends('layouts.mobile')

@section('content')
<div data-role="page" class="commmission_deal">
  <div data-role="content"  >

  <?php
     $room=$dealrecord->room();//d($room);
  ?>

    <ul data-role="listview" data-inset="true">
    	<li style="padding-left:1.5em" data-role="list-divider">佣金结算</li>
	 	 @if($room)
		<li>
		<div class="fy_grid4">
		<p class="c">房间：{{$room['project_name'].$room['building_name'].H::nullStr($room,'buildunit_name').$room['roomName']}}</p>
		</div>
		</li>
		@endif
		<li>
		<div class="fy_grid4">
		<p class="c">总价：{{$room['contractTotalAmount']}}</p>
		</div>
		</li>
		<li>
		<div class="fy_grid4">
		   <p class="c">佣金比率：{{H::trimz($dealrecord->percent)}}</p>
		</div>
		</li>
		<li>
		<div class="fy_grid4">
		<p class="c">应结佣金：<span id="span_commission">{{H::trimz($dealrecord->commission)}}</span></p><input type="hidden" id="commission" name="commission" value="{{$dealrecord->commission}}"  >
		</div>
		</li>
    </ul>

    <div class="item_div">
    @foreach($dealrecord->commissions as $commission)
    <ul class="dl_item" data-role="listview" data-inset="true">
		<li style="padding-left:1.5em" data-role="list-divider">&nbsp;</li>
		<li>
			<div class="fy_grid4">
			<p class="c">结算比例：{{H::trimz($commission->percent)}}</p>
			</div>
		</li>
		<li>
			<div class="fy_grid4">
			<p class="c">金额：{{H::trimz($commission->commission)}}</p>
			</div>
		</li>
		<li>
		<div class="fy_grid4">
			<p class='c'>顾问：{{$commission->counselor->name}}</p>
		</div>
		</li>
		<li>
		<div class="fy_grid4">
		<p class="c">日期：{{$commission->comdate_at}}</p>
		</div>
		</li>
    </ul>
    @endforeach
    </div>


  </div>
</div>
@stop