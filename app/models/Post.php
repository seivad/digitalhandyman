<?php

use Jenssegers\Mongodb\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletingTrait;

class Post extends Eloquent {

	use SoftDeletingTrait;

	protected $fillable = [];

	protected $collection = 'posts';

    protected $dates = ['deleted_at'];
	protected $softDelete = true;

}