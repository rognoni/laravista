@extends('layouts.app')

@section('content')
        <div class="row">
          <div class="col-sm-3">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('searchdown') }}" method="get">
                <div class="mb-3">
                  <label class="form-label">Full-text search</label>
                  <input type="text" name="search" value="{{{ $search }}}" class="form-control">
                  <div class="form-text">Use boolean full-text search
                    <a href="https://www.mysqltutorial.org/mysql-boolean-text-searches.aspx/">operators</a></div>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('searchdownAddLink') }}">Add link</a>
              </form>
          </div>
          <div class="col-sm-9">
            @foreach ($results as $result)
            <p>
              <code>{{ $result->updated_at->format('Y-m-d') }}</code>
              <a href="{{ $result->link }}">{{ \Illuminate\Support\Str::limit($result->markdown, 100, '...') }}</a>
            </p>
            @endforeach
          </div>
        </div>
@endsection
