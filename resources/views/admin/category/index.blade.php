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
    <div class="text-center card-header">
        <strong>Create Category</strong>
    </div>
    <div class="card-body">
        <form action="{{ route('admin#createCategory') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="categoryName">Category Name</label>
              <input type="text" name="categoryName" class="form-control @error('categoryName') is-invalid @enderror" id="categoryName">
              @error('categoryName')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
              @enderror
            </div>

            <div class="form-group">
                <label for="desc">Description</label>
                <textarea name="desc" id="desc" class="form-control @error('desc') is-invalid @enderror" cols="30" rows="10"></textarea>
                @error('desc')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
              </div>

            <button type="submit" class="btn btn-primary">Submit</button>
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

        <h3 class="card-title">Category List</h3>

        <div class="card-tools">
          <form action="{{route('admin#searchCategory')}}" method="post">
            @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="categoryKey" class="float-right form-control" value="{{request('categoryKey')}}" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
          </form>
        </div>
      </div>
      <!-- /.card-header -->
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
