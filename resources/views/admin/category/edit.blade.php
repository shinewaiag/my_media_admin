
@extends('admin.layouts.app')
@section('content')

<div class="col-5">
<div class="card">
    {{-- alert start --}}
    @if (session('createSuccess'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        {{session('createSuccess')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    {{-- alert end --}}
    <div class="card-header">
        <a class="text-dark text-bold" href="{{route('admin#category')}}">Back</a>
        <hr>
        <p  class="text-center text-bold">Edit Category</p>
    </div>
    <div class="card-body">
        <form action="{{ route('admin#updateCategory', $updateCategory->category_id) }}" method="post">
            @csrf
            <div class="form-group">
              <label for="categoryName">Category Name</label>
              <input type="text" name="categoryName" value="{{old('categoryName', $updateCategory->title)}}" class="form-control @error('categoryName') is-invalid @enderror" id="categoryName">
              @error('categoryName')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
              @enderror
            </div>

            <div class="form-group">
                <label for="desc">Description</label>
                <textarea name="desc" id="desc" class="form-control @error('desc') is-invalid @enderror" cols="30" rows="10">{{old('desc', $updateCategory->description)}}</textarea>
                @error('desc')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
              </div>

            <button type="submit" class="btn btn-dark">Update</button>
        </form>
    </div>
</div>
</div>
<div class="col-7">
    <div class="card">
      <div class="card-header">

        {{-- alert start --}}
        @if (session('deleteSuccess'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{session('deleteSuccess')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        {{-- alert end --}}
        <div class="p-0 card-body table-responsive">
            <table class="table text-center table-hover text-nowrap">
              <thead>
                <tr>
                  <th>Category ID</th>
                  <th>Category Name</th>
                  <th>Description</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($category as $c)
                <tr>
                  <td>{{ $c->category_id }}</td>
                  <td>{{$c->title}}</td>
                  <td>{{$c->description}}</td>
                  <td>
                    <a href="{{route('admin#categoryEditPage', $c->category_id)}}">
                        <button class="text-white btn btn-sm bg-dark"><i class="fas fa-edit"></i></button>
                    </a>
                    <a href="{{route('admin#deleteCategory', $c->category_id)}}">
                        <button class="text-white btn btn-sm bg-danger"><i class="fas fa-trash-alt"></i></button>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

@endsection
