@extends('admin.layouts.app')
@section('content')

<div class="mt-5 col-6 offset-3">
    <div class="card">
        <div class="card-header">
           <div class="text-center">
                <img class="text-center" width="300px" height="200px"
                @if ($post->image == null)
                    src="{{ asset('default/default.png') }}"
                @else
                    src="{{ asset('postImage/'. $post->image) }}">
                @endif
           </div>
        </div>
        <div class="card-body">
            <h3 class="text-center">{{$post->title}}</h3>
            <p class="text-start">{{$post->description}}</p>
        </div>
    </div>

    <!-- /.card -->
  </div>
  <a href="{{route('admin#trendPost')}}"><button class="btn btn-outline-dark">Back</button></a>

@endsection
