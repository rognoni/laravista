@extends('layouts.app')

@section('content')
<div class="row">
          <div class="col-sm">
            @isset($message)
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
            @endisset
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
            <form action="/L8x/admin/editor" method="post">
                @csrf
                <div class="mb-3">
                  <label class="form-label">Filename</label>
                  <input type="text" name="filename" value="{{{ $filename }}}" class="form-control">
                  <div class="form-text">The path/filename of the file to edit.</div>
                </div>
                <div class="mb-3">
                  <label class="form-label">File text</label>
                  <textarea name="filetext" class="form-control" rows="10">{{ $filetext }}</textarea>
                </div>
                <button type="submit" name="execute" value="open" class="btn btn-secondary">Open</button>
                <button type="submit" name="execute" value="save" class="btn btn-primary">Save</button>
              </form>
          </div>
        </div>
@endsection
