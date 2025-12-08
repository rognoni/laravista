@extends('layouts.app')

@section('head')
  @isset($id)
    @foreach($pages_chunk as $page_chunk)
      @foreach($page_chunk as $page)
        <meta property="og:title" content="{{ $page->title }}">
        <meta property="og:image" content="{{ $page->og_image_url }}">

        <meta name="twitter:card" content="summary_large_image">
        <meta property="twitter:domain" content="laravista.altervista.org">
        <meta property="twitter:url" content="{{ $page->url}}">
        <meta name="twitter:title" content="{{ $page->title }}">
        <meta name="twitter:image" content="{{ $page->og_image_url }}">
      @endforeach
    @endforeach
  @endisset
@endsection

@section('content')
<h1><i>Markdown-first</i> Federated Search</h1>

@isset($website) <p><b>website:</b> {{ $website }}</p> @endisset

<form action="{{ route('pages') }}">
  <input type="search" name="s" value="{{ $search }}" placeholder="Search" aria-label="Search" />
  <small id="email-helper">
    Use boolean full-text search
    <a href="https://dev.mysql.com/doc/refman/8.4/en/fulltext-boolean.html">operators</a>
  </small>
  <input type="hidden" name="w" value="{{ $website }}" />
  <input type="submit" value="Search" />
</form>

@foreach($pages_chunk as $page_chunk)
    <div class="grid">
    @foreach($page_chunk as $page)
        <div>
            <article>
                <img src="{{ $page->og_image_url }}">
                <hgroup>
                <h3>{{ $page->title }}</h3>
                <p>
                    <a href="{{ $page->url }}">page</a>
                    @isset($page->source_url) | <a href="{{ $page->source_url }}">source</a> @endisset
                    @isset($page->comments_url) | 💬<a href="{{ $page->comments_url }}">comments</a> @endisset
                </p>
                </hgroup>
            </article>
        </div>
    @endforeach
    </div>
@endforeach

{{ $pages->appends(['s' => $search, 'w' => $website])->links('vendor.pagination.default') }}

@endsection
