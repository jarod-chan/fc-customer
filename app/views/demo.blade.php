@extends('jqm')

@section('content')
<div data-role="page" class="commmission_deal">
  <div data-role="content"  >

   <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">佣金结算</li>
		<li>
			房间:xxxxxx
		</li>
    </ul>

    <div data-role="none"  style="background-color: red;">
    	<div data-role="none"  style="float: left;width:50%">结算比例:<input type="text"  style="width: 40px;"data-role="none" ></div>
    	<div data-role="none"  style="float: left;width:50%">金额:<input type="text"  style="width: 40px;"data-role="none" ></div>
    </div>
    <div style="clear: both"></div>

 <style type="text/css">
.controlgroup-textinput{
    padding-top:.22em;
    padding-bottom:.22em;
}
    </style>

    			<div data-role="controlgroup" data-type="horizontal">
			    <input type="text" id="search-control-group" data-wrapper-class="controlgroup-textinput ui-btn">
			    <button>提交</button>
			    <button>重置</button>
			</div>

	 <div data-inset="false">
	 <ul data-role="listview" >
		<li data-icon="delete" class="btn_delete"><a href="#">&nbsp;</a></li>

		<li>
		<div class="ui-grid-a">
		    <div class="ui-block-a ">
		    <input type="hidden"  name="commissionSet[-][id]" value=""  >
		    <div class="ui-field-contain">
		    <label>结算比例:</label>
		    <input type="text"  name="commissionSet[-][percent]" value=""  placeholder="结算比例">
		  	</div>
		    </div>
		    <div class="ui-block-b">
		    <div class="ui-field-contain">
		    <label>金额:</label>
		    <input type="text"  name="commissionSet[-][commission]" value="" placeholder='金额'>
		    </div>
		    </div>
		</div>
		</li>
		<li>
		 <div class="ui-field-contain">
	         <label for="text-12">Text input:</label>
	         <input type="text" name="text-12" id="text-12" value="">
	    </div>
		</li>

		<li>{{ Form::select("commissionSet[-][counselor_id]",H::prepend(null,"销售顾问"),'',array("data-native-menu"=>"false"))}}</li>
		<li><input type="date"  name="commissionSet[-][comdate_at]" value=""  placeholder="日期"></li>
    </ul>
    </div>

	</br>
    <div data-role="collapsible" data-inset="false">
    <h3>Pets</h3>
    <ul data-role="listview">
        <li><a href="#">Canary</a></li>
        <li><a href="#">Cat</a></li>
        <li><a href="#">Dog</a></li>
        <li><a href="#">Gerbil</a></li>
        <li><a href="#">Iguana</a></li>
        <li><a href="#">Mouse</a></li>
    </ul>
</div><!-- /collapsible -->

<form>
    <div class="ui-field-contain">
         <label for="text-12">Text input:</label>
         <input type="text" name="text-12" id="text-12" value="">
    </div>
    <div class="ui-field-contain">
         <label for="text-13">Text input: data-clear-btn="true"</label>
         <input type="text" data-clear-btn="true" name="text-13" id="text-13" value="">
    </div>
    <div class="ui-field-contain">
         <label for="search-8">Search:</label>
         <input type="search" name="search-8" id="search-8" value="">
    </div>
    <div class="ui-field-contain">
        <label for="textarea-12">Textarea:</label>
        <textarea cols="40" rows="8" name="textarea-12" id="textarea-12"></textarea>
    </div>
</form>

<div class="ui-grid-c">
    <div class="ui-block-a"><p>结算比例:</p></div>
    <div class="ui-block-b"><input type="text" name="text-12" id="text-12" value=""></div>
    <div class="ui-block-c"><p>结算比例:</p></div>
    <div class="ui-block-d"><input type="text" name="text-12" id="text-12" value=""></div>
</div>


  </div>
</div>
@stop