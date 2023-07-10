@extends('admin.layouts.app')
@section('content')

<div class="col-12">
    <div class="">
        {{-- alert start --}}
        @if (session('deleteSuccess'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session('deleteSuccess')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        {{-- alert end --}}
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Admin List</h3>

        <div class="card-tools">
          <form action="{{ route('admin#search') }}" method="post">
            @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="adminSearchKey" value="{{ request('adminSearchKey') }}" class="form-control float-right" placeholder="Search">

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
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Gender</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($userDatas as $userData)
            <tr>
              <td>{{ $userData['id'] }}</td>
              <td>{{ $userData['name'] }}</td>
              <td>{{ $userData['email'] }}</td>
              <td>{{ $userData['phone'] }}</td>
              <td>{{ $userData['address'] }}</td>
              <td>{{ $userData['gender'] }}</td>
              <td>
                {{-- <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button> --}}
                @if (Auth::user()->id == $userData['id'])
                <a href="#">
                    <button class="btn btn-sm bg-danger text-white" disabled><i class="fas fa-trash-alt"></i></button>
                </a>
                @else
                <a href="{{ route('admin#delete', $userData['id']) }}">
                    <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                </a>
                @endif
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
