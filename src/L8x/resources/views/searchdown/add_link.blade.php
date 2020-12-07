@extends('layouts.app')

@section('content')
        <div class="row">
          <div class="offset-md-2 col-sm-10">
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
            <form method="post">
                @csrf
                <div class="mb-3">
                  <label class="form-label">Link to HTML rendered page</label>
                  <input type="text" name="link" class="form-control" placeholder="https://">
                  <div class="form-text">
                    The page must contain the markdown source link with <code>data-media-type="text/markdown"</code>
                    attribute for the web-spider, for example:<br>
                    <a href="/L8x/md/index">
                        &lt;a data-media-type="text/markdown" href="https://raw.githubusercontent.com/rognoni/laravista/master/src/L8x/public/markdown/index.md">index.md&lt;/a>
                    </a>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Add link</button>
              </form>
          </div>
        </div>
@endsection
