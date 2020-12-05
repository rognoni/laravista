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
            <form action="register" method="post">
                @csrf
                <div class="mb-3">
                  <label class="form-label">Username</label>
                  <input type="text" name="username" value="{{{ old('username') }}}" class="form-control">
                  <div class="form-text">Use lower-case letters, numbers and no spaces.</div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" name="password" class="form-control">
                  <div class="form-text">Choose your password and remember it.</div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Password (repeat)</label>
                  <input type="password" name="password2" class="form-control">
                  <div class="form-text">Type again the same password to avoid errors.</div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Profile link</label>
                  <input type="text" name="profile_link" value="{{{ old('profile_link') }}}" class="form-control" placeholder="https://">
                  <div class="form-text">What is your personal homepage, blog or social profile?</div>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
              </form>
          </div>
        </div>
@endsection
