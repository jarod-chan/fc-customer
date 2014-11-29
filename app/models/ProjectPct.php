<?php
class ProjectPct extends Eloquent{

	protected $table = 'fc_projectpct';

	protected $primaryKey='sellproject_id';

	public $timestamps = false;

	protected $fillable = array('sellproject_id','percent');

}