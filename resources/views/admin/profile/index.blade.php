@extends('admin.layouts.app')

@section('content')

<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">User Profile</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">

                {{-- alert start --}}
                @if (session('updateSuccess'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Successfully Updated</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                {{-- alert end --}}

              <form class="form-horizontal" method="post" action="{{ route('admin#updateAdmin') }}">
                @csrf
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Enter Name" value="{{ old('name', $user->name) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Enter Email" value="{{old('email', $user->email)}}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="inputEmail" placeholder="Enter Phone" value="{{ old('phone', $user->phone) }}">
                      @error('phone')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Address" cols="30" rows="10">{{ old('address', $user->address) }}</textarea>
                      @error('address')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                      <select name="gender" class="form-control" id="">
                        @if ($user->gender == 'male')
                            <option value="empty">Chooese Gender</option>
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                        @elseif ($user->gender == 'female')
                            <option value="empty">Chooese Gender</option>
                            <option value="male">Male</option>
                            <option value="female" selected>Female</option>
                        @else
                            <option value="empty" selected>Chooese Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        @endif
                      </select>
                    </div>
                  </div>


                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Update</button>
                  </div>
                </div>
              </form>

              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <a href="{{ route('admin#password') }}">Change Password</a>
                </div>
              </div>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>


@endsection
