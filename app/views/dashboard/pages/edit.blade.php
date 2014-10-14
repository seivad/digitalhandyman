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

			<div class="form-group loadercenter">
			  {{ Form::label('content', 'Content', array('class' => 'control-label col-lg-3')) }}
			  <div class="col-lg-9">
			   {{ Form::textarea('content', null, array('class' => 'form-control summernote', 'id' => 'summernote')) }}
			   <div id='loader'><img src="{{ asset('/images/spinner.gif') }}"/></div>
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
			    <a href="{{ url('/') . $page->slug }}" class="btn btn-success">View</a>
			  </div>
			</div>				

		
		{{ Form::close() }}

	</div>	

	

	@stop

	@section('scripts')

	<script>
		$(document).ready(function() {

		var $loading = $('#loader').hide();
		$(document)
		  .ajaxStart(function () {
		    $loading.show();
		  })
		  .ajaxStop(function () {
		    $loading.hide();
		  });

			 $('#summernote').summernote({
		        height: "500px",
		        toolbar: [
					['style', ['style', 'bold', 'italic', 'underline', 'clear', 'strikethrough']],
					['para', ['ul', 'ol', 'paragraph']],
					['insert', ['picture', 'link', 'video', 'table', 'hr']],
					['misc', ['fullscreen', 'codeview']]
				],
		        onImageUpload: function(files, editor, welEditable) {
		            sendFile(files[0],editor,welEditable);
		        }
		    });
			        
		});

		function sendFile(file, editor, welEditable) {
			formData = new FormData();
			formData.append('key', '{{ $folder }}/' + file.name);
			formData.append('AWSAccessKeyId', '{{ $accessKeyId }}');
			formData.append('acl', 'public-read');
			formData.append('policy', '{{ $policy }}');
			formData.append('signature', '{{ $signature }}');
			formData.append('success_action_status', '201');
			formData.append('file', file);

			$.ajax({
				data: formData,
				dataType: 'xml',
				type: "POST",
				cache: false,
				contentType: false,
				processData: false,
				url: "https://{{ $bucket }}.s3.amazonaws.com/",
				success: function(data) {
				  // getting the url of the file from amazon and insert it into the editor
				  var url = $(data).find('Location').text();
				  editor.insertImage(welEditable, url);
				}
			});
	    }
	</script>

	@stop

@stop