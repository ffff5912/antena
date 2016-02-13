@extends('layout')

@section('content')
<div class="container">
    @foreach ($articles as $article)
        <div class="row">
            <article class="">
                <div class="">
                    <h2><a href="{{ $article->getUrl() }}">{{ $article->getTitle() }}</a></h2>
                    <p>{{ $article->getDescription() }}</p>
                </div>
            </article>
        </div>
    @endforeach
</div>
@stop
