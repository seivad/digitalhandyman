@extends('layouts.dashboard.master')

	@section('title')
		Digital Handyman Dashboard
	@stop

	@section('content')

	<div class="col-xs-12">

		@if(Session::has('message'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<strong>Success!</strong> {{ Session::get('message') }}
			</div>
		@endif

		<h1>Dashboard</h1>



	</div>
	
	@stop

@stop