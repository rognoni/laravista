@extends('layouts.app')

@section('content')
        <div class="row ">
          <div class="col-sm-2">
            <a data-media-type="text/markdown" href="{{ '/L8x/markdown/' . $filename }}">{{ $filename }}</a>
          </div>
          <div class="col-sm-10">
            {!! $html !!}
          </div>
        </div>
@endsection
