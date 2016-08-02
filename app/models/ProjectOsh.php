<?php
class ProjectOsh extends Eloquent{

	protected $table = 'fc_projectosh';

	protected $primaryKey='sellproject_id';

	public $timestamps = false;

	protected $fillable = array('sellproject_id','onshow');

}