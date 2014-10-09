<?php namespace Digitalhandyman\Helpers;

class Breadcrumbs {

	public function __construct() {
		
	}

	public function breadcrumbs() {

		$crumbs = explode("/",$_SERVER["REQUEST_URI"]);
		array_shift($crumbs);

		$linkCrumbs = $crumbs;

		$text = '';
		$items = count($linkCrumbs);
		$i = 0;
		$links = array();

		foreach($linkCrumbs as $link) {

			if(++$i > 0) {
				$text = $text . '/' . $link;
			} else {
				$text;
			}

			$links[] = $text;
		}

		$breadcrumbs = '<ol class="breadcrumb">
							<li><a href="'. URL('/').'">Home</a></li>';
		
		foreach($crumbs as $key => $crumb) {

			if(end($crumbs) !== $crumb)
			{
		    	$breadcrumbs .= '<li><a href="'. URL('/') . $links[$key] .'">'. ucwords(str_replace(array("_","-"),array(""," "),$crumb)) .'</a></li>';
			} 
			else
			{
				$breadcrumbs .= '<li class="active">'. ucwords(str_replace(array("_","-"),array(""," "),$crumb)) .'</li></ol>';
			}
		}

		return $breadcrumbs;

	}

}