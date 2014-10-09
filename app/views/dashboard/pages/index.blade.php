@extends('layouts.dashboard.master')

	@section('title')
		All Pages
	@stop

	@section('content')

	<div class="col-xs-12">

		@if(Session::has('message'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<strong>Success!</strong> {{ Session::get('message') }}
			</div>
		@endif

		<h1>Pages</h1>
		
		@forelse($pages as $page)
		<div class="row">
			<div class="col-md-6">
				

				 <h3>{{ (!empty($page->parent) ? '<span class="text-muted">'.ucwords(str_replace("/", " / ", str_replace("-", " ", $page->parent))) . '</span> / <a href="'.route('dashboard.pages.edit', $page->_id).'">' . $page->title .'</a>' : '<a href="'.route('dashboard.pages.edit', $page->_id).'">' . $page->title . '</a>') }}</h3>

				
				<p>{{ substr($page->content, 0, 220) . '...' }}</p>
			</div>
			<div class="col-md-3">
				<p>
					<strong>Meta Title:</strong><br /> {{ $page->meta['metaTitle'] }}<br />
					<strong>Meta Keywords:</strong><br /> {{ implode($page->meta['metaKeywords'], ', ') }}<br />
					<strong>Meta Description:</strong><br /> {{ $page->meta['metaDescription'] }}
				</p>
			</div>
			<div class="col-md-3">
				{{ Form::open(array('route' => array('dashboard.pages.destroy', $page->_id), 'method' => 'DELETE')) }}
				<div class="form-group">
					<a href="{{ route('pages.view', $page->slug) }}"  target="_blank" class="btn btn-primary">View</a>
					<a href="{{ route('dashboard.pages.edit', $page->_id) }}" class="btn btn-info">Edit</a>
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