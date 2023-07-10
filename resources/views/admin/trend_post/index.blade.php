@extends('admin.layouts.app')
@section('content')

<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trending Posts</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="float-right form-control" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="p-0 card-body table-responsive">
        <table class="table text-center table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Post Title</th>
              <th>Image</th>
              <th>View Count</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{$post->post_id}}</td>
                <td>{{$post->title}}</td>
                <td><img width="100px" height="100px"
                    @if ($post->image == null)
                        src="{{ asset('default/default.png') }}"
                    @else
                    src="{{ asset('postImage/'. $post->image) }}">
                    @endif
                  </td>
                <td>{{$post->post_count}}</td>
                <td>
                  <a href="{{route('admin#details', $post->post_id)}}">
                    <button class="text-white btn btn-sm bg-dark"><i class="fa-regular fa-file-lines"></i></button>
                  </a>
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
        {{-- <div class="mt-3 d-flex justify-content-center">
            {{$posts->links()}}
        </div> --}}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

@endsection
