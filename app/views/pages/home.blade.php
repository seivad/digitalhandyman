@extends('layouts.frontend.master')

	@section('content')
		<h1>Home Page</h1>

					@if($errors->has())
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					@foreach($errors->all() as $error)
					<strong>Error!</strong> {{ $error }}<br />
					@endforeach
				</div>
			@endif

	@stop

@stop