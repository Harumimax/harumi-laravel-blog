@extends('layouts.app')

@if (Session::has('flash_message'))
	{{ Session::get('flash_message') }}
@endif

<center><a href="{{ route('articles.create') }}">Создать</a></center>
@section('content')
    <h1>Список статей</h1>
    @foreach ($articles as $article)
        <h2><a href="{{ route('articles.show', $article->id) }}">{{ $article->name }}</a> - <a href="{{ route('articles.edit', $article->id) }}">ИЗМЕНИТЬ СТАТЬЮ</a></h2>
        {{ Form::model($article, ['url' => route('articles.destroy', $article), 'method' => 'DELETE', 'onsubmit' => 'return confirm("are you sure ?")']) }}
            {{ Form::submit('УДАЛИТЬ') }}
        {{ Form::close() }}
        <div>{{Str::limit($article->body, 200)}}</div>
    @endforeach
@endsection
