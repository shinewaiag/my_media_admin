@extends('admin.layouts.app')

@section('content')

<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Change Password</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">

                {{-- alert start --}}
                @if (session('passwordChanged'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>{{session('passwordChanged')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @elseIf(session('noMatch'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{session('noMatch')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif
                {{-- alert end --}}

              <form class="form-horizontal" method="post" action="{{ route('admin#changePassword') }}">
                @csrf

                <div class="form-group row">
                    <label for="inputOldPassword" class="col-sm-3 col-form-label">Old Password</label>
                    <div class="col-sm-9">
                      <input type="password" name="oldPassword" class="form-control @error('oldPassword') is-invalid @enderror" id="inputOldPassword" placeholder="Enter old Password">
                      @error('oldPassword')
                          <div class="invalid-feedback">
                              {{$message}}
                          </div>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputNewPassword" class="col-sm-3 col-form-label">New Password</label>
                    <div class="col-sm-9">
                      <input type="password" name="newPassword" class="form-control @error('newPassword') is-invalid @enderror" id="inputNewPassword" placeholder="Enter new Password">
                      @error('newPassword')
                          <div class="invalid-feedback">
                              {{$message}}
                          </div>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputConfirmedPassword" class="col-sm-3 col-form-label">Confirmed Password</label>
                    <div class="col-sm-9">
                      <input type="password" name="confirmedPassword" class="form-control @error('confirmedPassword') is-invalid @enderror" id="inputConfirmedPassword" placeholder="Enter confirmed Password">
                      @error('confirmedPassword')
                          <div class="invalid-feedback">
                              {{$message}}
                          </div>
                      @enderror
                    </div>
                  </div>



                <div class="form-group row">
                  <div class="offset-sm-4 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Change Password</button>
                  </div>
                </div>
              </form>


            </div>
            </div>
          </div>
        </div>
      </div>
    </div>


@endsection
