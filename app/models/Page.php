<?php

use Jenssegers\Mongodb\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletingTrait;

class Page extends Eloquent {

	use SoftDeletingTrait;

	protected $fillable = [];

	protected $collection = 'pages';

    protected $dates = ['deleted_at'];
	protected $softDelete = true;


}