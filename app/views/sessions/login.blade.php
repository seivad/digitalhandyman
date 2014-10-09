@extends('layouts.frontend.master-fullwidth')

	@section('content')

	<div class="row">
		<div class="col-md-6 col-md-offset-3">

			@if($errors->has())
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					@foreach($errors->all() as $error)
					<strong>Error!</strong> {{ $error }}<br />
					@endforeach
				</div>
			@endif

			{{ Form::open(array('class' => 'form-horizontal')) }}
			  <fieldset>
			    <legend>Login</legend>
			    <div class="form-group">
			      	{{ Form::label('email', 'Email Address', array('class' => 'control-label col-lg-3')) }}
			      <div class="col-lg-9">
			        {{ Form::email('email', null, array('class' => 'form-control')) }}
			      </div>
			    </div>
			    <div class="form-group">
			      {{ Form::label('password', 'Password', array('class' => 'control-label col-lg-3')) }}
			      <div class="col-lg-9">
			       {{ Form::password('password', array('class' => 'form-control')) }}
			      </div>
			    </div>
			    <div class="form-group">
			      <div class="col-lg-9 col-lg-offset-3">
			        {{ Form::submit('Login', array('class' => 'btn btn-primary')) }}
			        <a href="{{ URL('/') }}" class="btn btn-default">Go Back</a>
			      </div>
			    </div>
			  </fieldset>
			{{ Form::close() }}

		</div><!-- /offset 3 -->
	</div><!-- /row -->

	@stop

@stop


