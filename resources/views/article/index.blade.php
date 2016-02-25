@extends('layout')

@section('content')
<div class="container">
    @foreach ($articles as $article)
        <div class="row">
            <article class="">
                <div class="">
                    <h2><a href="{{ $article->getUrl() }}">{{ $article->getTitle() }}</a></h2>
                    <p>{{ $article->getDescription() }}</p>
                    <span>カテゴリ:
                        <a href="{{ action('ArticleSearchController@showCategory', ['category' => $article->getFeed()->getCategory()]) }}">
                            {{ $article->getFeed()->getCategory() }}
                        </a>
                    </span>
                    <span>タグ:{{ $article->getFeed()->getTag() }}</span>
                </div>
            </article>
        </div>
    @endforeach
</div>
<div class="container">
    <div class="row text-center">
        @if ($max_pages > 1)
            <ul class="pagination pagination-sm">
                <li @if ($current_page == 1) 'class="disabled"' @endif>
                    <a href="{{ action('ArticleController@index', ['page' => $current_page - 1 < 1 ? 1 : $current_page - 1]) }}">«</a>
                </li>

                @for ($i = 1; $i < $max_pages; $i++)
                    <li @if ($current_page == $i) 'class="active"' @endif>
                        <a href="{{ action('ArticleController@index', ['page' => $i]) }}">{{ $i }}</a>
                    </li>
                @endfor

                <li @if ($current_page == $max_pages) 'class="disabled"' @endif>
                    <a href="{{ action('ArticleController@index', ['page' => $current_page + 1 <= $max_pages ? $current_page + 1 : $current_page]) }}">»</a>
                </li>
            </ul>
        @endif
    </div>
</div>
@stop
