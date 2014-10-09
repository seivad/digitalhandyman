@extends('layouts.dashboard.master')

	@section('title')
		Create A New Page
	@stop

	@section('content')

	<div class="col-xs-12 col-md-8">

		<h1>Create A New Page</h1>

		{{ Form::open(array('route' => 'dashboard.pages.store','class' => 'form-horizontal')) }}

		<fieldset>
		<legend>Put on your thinking cap!</legend>

			@if($errors->has())
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					@foreach($errors->all() as $error)
					<strong>Error!</strong> {{ $error }}<br />
					@endforeach
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
			    {{ Form::text('metaTitle', null, array('class' => 'form-control')) }}
			</div>

			<div class="form-group">
			  	{{ Form::label('metaKeywords', 'Meta Keywords', array('class' => 'control-label')) }}
			    {{ Form::text('metaKeywords', null, array('class' => 'form-control')) }}
			</div>

			<div class="form-group">
			  {{ Form::label('metaDescription', 'Meta Description', array('class' => 'control-label')) }}
			  {{ Form::textarea('metaDescription', null, array('class' => 'form-control', 'rows' => '3')) }}
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