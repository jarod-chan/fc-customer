<?php
class Q{
	public static function last(){
		$queries = DB::getQueryLog();
		$last_query = end($queries);
		s($last_query);
	}
}