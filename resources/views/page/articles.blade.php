
@extends('layouts.app')
@section('title', 'HarumiMax Blog Laravel')
@section('header', 'Articlesss')

	@section('content')
	    @foreach ($articles as $article)
		<p>{{ $article->name }}</p>
		<p>{{ $article->body }}</p>
		<hr>
	    @endforeach
	@endsection


