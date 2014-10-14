@extends('layouts.dashboard.master')

	@section('title')
		Deleted Pages
	@stop

	@section('content')

	<div class="col-xs-12">

		@if(Session::has('message'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<strong>Success!</strong> {{ Session::get('message') }}
			</div>
		@endif

		<h1>Deleted Pages</h1>
	
		@forelse($pages as $page)
		<div class="row">
			<div class="col-md-6">
			<h2>{{ $page->title }}</h2>
				<p>{{ substr($page->content, 0, 250) . '...' }}</p>
			</div>
			<div class="col-md-3">
				<p>
					<strong>Meta Title:</strong><br /> {{ $page->meta['metaTitle'] }}<br />
					<strong>Meta Keywords:</strong><br /> {{ implode($page->meta['metaKeywords'], ', ') }}<br />
					<strong>Meta Description:</strong><br /> {{ $page->meta['metaDescription'] }}
				</p>
			</div>
			<div class="col-md-3">
				{{ Form::open(array('route' => array('dashboard.pages.restore', $page->_id), 'method' => 'page')) }}
				<div class="form-group">
					{{ Form::submit('Restore', array('class' => 'btn btn-primary') ) }}
				</div>
				{{ Form::close() }}
				{{ Form::open(array('route' => array('dashboard.pages.destroy', $page->_id), 'method' => 'DELETE')) }}
				<div class="form-group">
					{{ Form::hidden('force', true) }}
					{{ Form::submit('Delete', array('class' => 'btn btn-danger') ) }}
				</div>
				{{ Form::close() }}
			</div>
		</div>
		<hr />
		@empty
			<p><strong>Opps!</strong> No Pages Available</p>
		@endforelse
		

	</div>
	@stop

@stop