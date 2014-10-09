@extends('layouts.frontend.master')


	@section('title')
		{{ $page->meta['metaTitle'] }}
	@stop

	@if($page->meta['metaKeywords'])
		@section('metaKeywords')
			<meta name="keywords" content="{{ implode($page->meta['metaKeywords'], ', ') }}">
		@stop
	@endif

	@if(!empty($page->meta['metaDescription']))
		@section('metaDescription')
			<meta name="description" content="{{ $page->meta['metaDescription'] }}">
		@stop
	@endif


	@section('content')

		<h1>{{ $page->title }}</h1>

		{{ $breadcrumbs->breadcrumbs() }}

		{{ $page->content }}
	@stop

@stop