@extends('layouts.dashboard.master')

	@section('title')
		All Posts
	@stop

	@section('content')

	<div class="col-xs-12">

		@if(Session::has('message'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<strong>Success!</strong> {{ Session::get('message') }}
			</div>
		@endif

		<h1>Posts</h1>
		
		@forelse($posts as $post)
		<div class="row">
			<div class="col-md-6">
			<h2>{{ $post->title }}</h2>
				<p>{{ substr($post->content, 0, 250) . '...' }}</p>
			</div>
			<div class="col-md-3">
				<p><strong>Tags:</strong><br /> {{ implode($post->tags, ', ') }}<br />
					<strong>Category:</strong><br /> {{ $post->category }}<br />
					<strong>Meta Title:</strong><br /> {{ $post->meta['metaTitle'] }}<br />
					<strong>Meta Keywords:</strong><br /> {{ implode($post->meta['metaKeywords'], ', ') }}<br />
					<strong>Meta Description:</strong><br /> {{ $post->meta['metaDescription'] }}</p>
			</div>
			<div class="col-md-3">
				{{ Form::open(array('route' => array('dashboard.posts.destroy', $post->_id), 'method' => 'DELETE')) }}
				<div class="form-group">
					<a href="{{ route('dashboard.posts.edit', $post->_id) }}" class="btn btn-primary">Edit</a>
					{{ Form::submit('Delete', array('class' => 'btn btn-danger') ) }}
				</div>
				{{ Form::close() }}
			</div>
		</div>
		<hr />
		@empty
			<p><strong>Opps!</strong> No Posts Available</p>
		@endforelse
		

	</div>
	@stop

@stop