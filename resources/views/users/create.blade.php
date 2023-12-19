@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users Create') }}</div>

                <div class="card-body">
                @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible" id="div_success_msg">
                            {{ session()->get('success') }}
                        </div>
                @endif

                    <form action="{{url('users-store')}}" method="post" class="row g-3" name="frm_users" id="frm_users" enctype="multipart/form-data" novalidate>
                    @csrf
                    
                    <div class="col-7">
                      <label for="name" class="form-label">Name:<span class="text-danger">*</span></label>
                      <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" required>
                      
                      @error('name')
                      <span class="text-danger">
                          <div class="invalid-feedback" ></div>
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="col-7">
                      <label for="email" class="form-label">Email:<span class="text-danger">*</span></label>
                      <input type="text" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email ID" required>
                      
                      @error('email')
                      <span class="text-danger">
                          <div class="invalid-feedback" ></div>
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="col-7">
                      <label for="password" class="form-label">Password:<span class="text-danger">*</span></label>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                      @error('password')
                      <span class="text-danger">
                          <div class="invalid-feedback" ></div>
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="col-7">
                      <label for="password-confirm" class="form-label">Confirm Password:<span class="text-danger">*</span></label>
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    
                    <div class="col-7">
                        <input type = "submit" name = "submit" value = "SAVE" class="btn btn-outline-primary">                       
                        <input type="reset" class="btn btn-outline-dark" value="Reset">
                        <a class="btn btn-outline-danger" href="{{ url('users') }}">Back</a>
                    </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection