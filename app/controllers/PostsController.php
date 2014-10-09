<?php

class PostsController extends \BaseController {

	private function create_slug($string)
	{
	   $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	   return urlencode(strtolower($slug));
	}

	/**
	 * Display a listing of the resource.
	 * GET /posts
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::all();

		return View::make('dashboard.posts.index', compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /posts/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('dashboard.posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /posts
	 *
	 * @return Response
	 */
	public function store()
	{

		$rules = array(
				'title' => 'required',
				'content' => 'required',
				'category' => 'required',
				'tags' => 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return Redirect::route('dashboard.posts.create')->withErrors($validator)->withInput();
		}

		$post = new Post;
		$post->title = ucwords(strtolower(Input::get('title')));
		$post->slug = $this->create_slug(Input::get('title'));
		$post->content = Input::get('content');
		$post->tags = explode(', ', Input::get('tags'));
		$post->category = Input::get('category');
		$post->meta = array(
				'metaTitle' =>  ucwords(strtolower(Input::get('metaTitle'))),
				'metaDescription' => Input::get('metaDescription'),
				'metaKeywords' => explode(', ', Input::get('metaKeywords'))
			);
		$post->save();

		return Redirect::route('dashboard.posts.index')->with('message', 'Post successfully created!');

	}

	/**
	 * Display the specified resource.
	 * GET /posts/{id}
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
	 * GET /posts/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = Post::find($id);

		return View::make('dashboard.posts.edit', compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /posts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
				'title' => 'required',
				'content' => 'required',
				'category' => 'required',
				'tags' => 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return Redirect::route('dashboard.posts.create')->withErrors($validator)->withInput();
		}

		$post = Post::find($id);

		$post->title = ucwords(strtolower(Input::get('title')));
		$post->slug = $this->create_slug(Input::get('title'));
		$post->content = Input::get('content');
		$post->tags = explode(', ', Input::get('tags'));
		$post->category = Input::get('category');
		$post->meta = array(
				'metaTitle' =>  ucwords(strtolower(Input::get('metaTitle'))),
				'metaDescription' => Input::get('metaDescription'),
				'metaKeywords' => explode(', ', Input::get('metaKeywords'))
			);
		
		if($post->save()) {
			return Redirect::route('dashboard.posts.edit', $post->_id)->with('message', 'Updated successfully');
		}

		return Redirect::route('dashboard.posts.edit', $post->_id)->withErrors('errors', 'unexpected error!');


	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /posts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		$post = Post::withTrashed()->find($id);

		if(Input::get('force') == 1) {
			//Permanently Delete
			$post->forceDelete();
		} else {
			//Soft Delete
			$post->delete();	
		}
			
		if($post) {
			return Redirect::route('dashboard.posts.index')->with('message', 'Successfully deleted the post!');
		}

		return Redirect::route('dashboard.posts.index')->withErrors($post, 'Could not delete post!');

	}

	public function restore($id)
	{

		$post = Post::withTrashed()->find($id);
		$post->restore();

		if($post) {
			return Redirect::route('dashboard.posts.index')->with('message', 'Successfully restored the post!');
		}

		return Redirect::route('dashboard.posts.deleted')->withErrors($post, 'Could not restore post!');

	}

	public function deletedPosts()
	{
		$posts = Post::onlyTrashed()->get();

		if($posts) {
			return View::make('dashboard.posts.deleted', compact('posts'));
		}

		return Redirect::route('dashboard.posts.index');
	}

}