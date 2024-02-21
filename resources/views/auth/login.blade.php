@extends('layouts.auth')

@section('content')
    <div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                <div class="my-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="exampleFormControlInput1" class="form-label"><span><i class="email"></i></span>
                                    Email Address</label>
                                <input class="form-control form-control-md @error('email') is-invalid @enderror"
                                    type="email" name="email" value="{{ old('email') }}" required>
                                <div class="col-md-6">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <input id="password" type="password"
                                    class="form-control form-control-md @error('password') is-invalid @enderror"
                                    name="password">

                                <div class="col-md-6">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0 mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success w-100">
                                    {{ __('Continue') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade show" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
                <div class="my-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                <input class="form-control form-control-md @error('name') is-invalid @enderror"
                                    type="text" name="name" value="{{ old('name') }}" required>
                                <div class="col-md-6">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                <input class="form-control form-control-md @error('email') is-invalid @enderror"
                                    type="email" name="email" value="{{ old('email') }}" required>
                                <div class="col-md-6">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <input id="password" type="password"
                                    class="form-control form-control-md @error('password') is-invalid @enderror"
                                    name="password" required>

                                <div class="col-md-6">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control form-control-md"
                                    name="password_confirmation">

                                <div class="col-md-6">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0 mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success w-100">
                                    {{ __('Continue') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
