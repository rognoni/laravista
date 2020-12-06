@extends('layouts.app')

@section('content')
        <div class="row justify-content-center">
          <div class="col-sm-4">
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
            <form action="login" method="post">
                @csrf
                <div class="mb-3">
                  <label class="form-label">Username</label>
                  <input type="text" name="username" value="{{{ old('username') }}}" class="form-control">
                </div>
                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" name="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="{{ route('register') }}">Register</a>
              </form>
          </div>
        </div>
@endsection
