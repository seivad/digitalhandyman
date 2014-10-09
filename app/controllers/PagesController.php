<?php

use Digitalhandyman\Helpers\Breadcrumbs as Breadcrumbs;

class PagesController extends \BaseController {

	private function create_slug($string)
	{
	   $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	   return urlencode(strtolower($slug));
	}


	private function breadcrumbs() {

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
		    	$breadcrumbs .= '<li><a href="'. $links[$key] .'">'. ucwords(str_replace(array("_","-"),array(""," "),$crumb)) .'</a></li>';
			} 
			else
			{
				$breadcrumbs .= '<li class="active">'. ucwords(str_replace(array("_","-"),array(""," "),$crumb)) .'</li></ol>';
			}
		}

		return $breadcrumbs;

	}

	/**
	 * Display a listing of the resource.
	 * GET /pages
	 *
	 * @return Response
	 */
	public function index()
	{
		$pages = Page::all();

		return View::make('dashboard.pages.index', compact('pages'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /pages/create
	 *
	 * @return Response
	 */
	public function create()
	{

		$slugs = Page::whereNotNull('slug')->get(array('slug'))->toArray();

		$result = array();
		foreach($slugs as $slug)
			$result[$slug['slug']] = $slug['slug'];

		return View::make('dashboard.pages.create', compact('result'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /pages
	 *
	 * @return Response
	 */
	public function store()
	{

		$rules = array(
				'title' => 'required',
				'content' => 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return Redirect::route('dashboard.pages.create')->withErrors($validator)->withInput();
		}

		$page = new Page;
		$page->title = ucwords(strtolower(Input::get('title')));
		$page->slug = $this->create_slug(Input::get('title'));
		$page->content = Input::get('content');
		$page->meta = array(
				'metaTitle' =>  ucwords(strtolower(Input::get('metaTitle'))),
				'metaDescription' => Input::get('metaDescription'),
				'metaKeywords' => explode(', ', Input::get('metaKeywords'))
			);
		$page->save();

		return Redirect::route('dashboard.pages.index')->with('message', 'Post successfully created!');

	}

	public function view($slug = 'home')
	{

		$page = Page::whereSlug($slug)->firstOrFail();
		//$breadcrumbs = $this->breadcrumbs();
		$breadcrumbs = new Breadcrumbs;

		if($page) {
			return View::make('pages.index', compact('page', 'breadcrumbs'));
		}

		return 'error';
	}




	/**
	 * Display the specified resource.
	 * GET /pages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /pages/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$page = Page::find($id);

		$slugs = Page::whereNotNull('slug')->get(array('slug'))->toArray();

		$result = array('' => '-');
		foreach($slugs as $slug)
			$result[$slug['slug']] = $slug['slug'];

		return View::make('dashboard.pages.edit', compact('page', 'result'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /pages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
				'title' => 'required',
				'content' => 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return Redirect::route('dashboard.pages.create')->withErrors($validator)->withInput();
		}

		$page = Page::find($id);

		$page->title = ucwords(strtolower(Input::get('title')));

		if(!empty(Input::get('parent'))) {
			$page->slug = Input::get('parent') . '/' . $this->create_slug(Input::get('title'));
		} else {
			$page->slug = $this->create_slug(Input::get('title'));
		}
		if(!empty(Input::get('parent'))) {
			$page->parent = Input::get('parent');
		} else {
			$page->parent = null;
		}
		$page->content = Input::get('content');
		$page->meta = array(
				'metaTitle' =>  ucwords(strtolower(Input::get('metaTitle'))),
				'metaDescription' => Input::get('metaDescription'),
				'metaKeywords' => explode(', ', Input::get('metaKeywords'))
			);
		
		if($page->save()) {
			return Redirect::route('dashboard.pages.edit', $page->_id)->with('message', 'Updated successfully');
		}

		return Redirect::route('dashboard.pages.edit', $page->_id)->withErrors('errors', 'unexpected error!');


	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /pages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		$page = Page::withTrashed()->find($id);

		if(Input::get('force') == 1) {
			//Permanently Delete
			$page->forceDelete();
		} else {
			//Soft Delete
			$page->delete();	
		}
			
		if($page) {
			return Redirect::route('dashboard.pages.index')->with('message', 'Successfully deleted the post!');
		}

		return Redirect::route('dashboard.pages.index')->withErrors($page, 'Could not delete post!');

	}

	public function restore($id)
	{

		$page = Page::withTrashed()->find($id);
		$page->restore();

		if($page) {
			return Redirect::route('dashboard.pages.index')->with('message', 'Successfully restored the post!');
		}

		return Redirect::route('dashboard.pages.deleted')->withErrors($page, 'Could not restore post!');

	}

	public function deletedpages()
	{
		$pages = Page::onlyTrashed()->get();

		if($pages) {
			return View::make('dashboard.pages.deleted', compact('pages'));
		}

		return Redirect::route('dashboard.pages.index');
	}

}