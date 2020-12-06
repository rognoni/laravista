@extends('layouts.app')

@section('content')
    Welcome <code>{{ Auth::user()->username }}</code> your role is <b>{{ Auth::user()->role }}</b>
@endsection
