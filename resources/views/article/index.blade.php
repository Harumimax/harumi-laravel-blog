@extends('layouts.app')

@if (Session::has('flash_message'))
	{{ Session::get('flash_message') }}
@endif


@section('content')
<div class="container">
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-6">
<center><a href="{{ route('articles.create') }}">Создать</a></center>
    <h1>Список статей</h1>


    @foreach ($articles as $article)
            <article class="col">
            <div class="card">
                <div class="card-body">
                <h2 class="card-title"><a href="{{ route('articles.show', $article->id) }}">{{ $article->name }}</a></h2>
                <a href="{{ route('articles.edit', $article->id) }}">ИЗМЕНИТЬ СТАТЬЮ</a>
                {{ Form::model($article, ['url' => route('articles.destroy', $article), 'method' => 'DELETE', 'onsubmit' => 'return confirm("are you sure ?")']) }}
                    {{ Form::submit('УДАЛИТЬ') }}
                {{ Form::close() }}
                <p class="card-text">{{Str::limit($article->body, 200)}}</p>
                </div>
            </div>
            </article>
    @endforeach
</div>
</div>
@endsection
