@extends('layouts.dashboard.master')

	@section('title')
		Edit {{ $page->title }}
	@stop

	@section('content')

	<div class="col-xs-12 col-md-8">
	
		<h1>Edit {{ $page->title }}</h1>

		{{ Form::model($page, array('route' => array('dashboard.pages.update', $page->_id), 'method' => 'PUT','class' => 'form-horizontal')) }}

			<fieldset>
			<legend>Rethinking what you said?</legend>

			@if($errors->has())
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					@foreach($errors->all() as $error)
					<strong>Error!</strong> {{ $error }}<br />
					@endforeach
				</div>
			@endif

			@if(Session::has('message'))
				<div class="alert alert-success alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<strong>Success!</strong> {{ Session::get('message') }}
				</div>
			@endif

			<div class="form-group">
			  	{{ Form::label('title', 'Title', array('class' => 'control-label col-lg-3')) }}
			  <div class="col-lg-9">
			    {{ Form::text('title', null, array('class' => 'form-control')) }}
			  </div>
			</div>

			<div class="form-group">
			  	{{ Form::label('slug', 'Slug', array('class' => 'control-label col-lg-3')) }}
			  <div class="col-lg-9">
			    {{ Form::text('slug', null, array('class' => 'form-control')) }}
			  </div>
			</div>

			<div class="form-group">
			  	{{ Form::label('parent', 'Parent Page', array('class' => 'control-label col-lg-3')) }}
			  <div class="col-lg-9">
			    {{ Form::select('parent', $result, null, array('class' => 'form-control')) }}
			  </div>
			</div>

			<div class="form-group">
			  {{ Form::label('content', 'Content', array('class' => 'control-label col-lg-3')) }}
			  <div class="col-lg-9">
			   {{ Form::textarea('content', null, array('class' => 'form-control summernote')) }}
			  </div>
			</div>

			</fieldset>		

	</div>
	<div class="col-xs-12 col-md-4">

			<h3>Meta Tags</h3>
			<div class="form-group">
			  	{{ Form::label('metaTitle', 'Meta Title', array('class' => 'control-label')) }}
			  	<input type="text" name="metaTitle" id="metaTitle"  class="form-control" value="{{ $page->meta['metaTitle'] }}" />
			</div>

			<div class="form-group">
			  	{{ Form::label('metaKeywords', 'Meta Keywords', array('class' => 'control-label')) }}
			  	<input type="text" name="metaKeywords" id="metaKeywords" class="form-control" value="{{ implode(', ', $page->meta['metaKeywords']) }}" />
			</div>

			<div class="form-group">
			  {{ Form::label('metaDescription', 'Meta Description', array('class' => 'control-label')) }}
			  <textarea name="metaDescription" id="metaDescription" rows="3" class="form-control">{{ $page->meta['metaDescription'] }}</textarea>
			</div>

	</div>
	
	<div class="col-xs-12 col-md-8">			

			<div class="form-group">
			  <div class="col-lg-9 col-lg-offset-3">
			    {{ Form::submit('Save Page', array('class' => 'btn btn-primary')) }}
			    <a href="{{ route('dashboard.pages.index') }}" class="btn btn-default">Go Back</a>
			  </div>
			</div>				

		
		{{ Form::close() }}

	</div>	

	@stop

@stop