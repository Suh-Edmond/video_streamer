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
                                <label for="exampleFormControlInput1" class="form-label">
                                    <span><i class="fa-solid fa-envelope"></i></span>
                                     <span class="fw-bold">Email</span>
                                </label>
                                <div class="input-group">
                                    <input class="form-control form-control-md @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required>
                                </div>
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
                                <label for="exampleFormControlInput1" class="form-label">
                                    <span><i class="fa-solid fa-lock"></i></span>
                                    <span class="fw-bold">Password</span>
                                </label>
                                <div class="input-group"  id="show_hide_password">
                                    <input id="password" type="password"
                                        class="form-control form-control-md @error('password') is-invalid @enderror"
                                        name="password" aria-describedby="basic-addon2">
                                    <a class="input-group-text" id="basic-addon2"><i class="fa-solid fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
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
                                <button type="submit" class="btn btn-success w-100 fw-bold">
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
                                <label for="exampleFormControlInput1" class="form-label">
                                    <span><i class="fa-solid fa-user"></i></span>
                                    <span class="fw-bold">Name</span>
                                </label>
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
                                <label for="exampleFormControlInput1" class="form-label">
                                    <span><i class="fa-solid fa-envelope"></i></span>
                                    <span class="fw-bold">Email</span>
                                </label>
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
                                <label for="exampleFormControlInput1" class="form-label">
                                    <span><i class="fa-solid fa-lock"></i></span>
                                    <span class="fw-bold">Password</span>
                                </label>
                                <div class="input-group"  id="show_hide_password">
                                    <input id="password" type="password"
                                           class="form-control form-control-md @error('password') is-invalid @enderror"
                                           name="password" required aria-describedby="basic-addon2">
                                    <a class="input-group-text" id="basic-addon2"><i class="fa-solid fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
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
                                <label for="exampleFormControlInput1" class="form-label">
                                    <span><i class="fa-solid fa-lock"></i></span>
                                    <span class="fw-bold">Confirm Password</span>
                                </label>
                                <div class="input-group"  id="show_hide_confirm_password">
                                <input id="password-confirm" type="password" class="form-control form-control-md"
                                    name="password_confirmation" required aria-describedby="basic-addon2">
                                    <a class="input-group-text" id="basic-addon2"><i class="fa-solid fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
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
                                <button type="submit" class="btn btn-success w-100 fw-bold">
                                    {{ __('Continue') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .input-group-text {
            color: black;
            cursor: pointer;
        }
        .input-group-text:hover {
            color: black;
            cursor: pointer;
        }
    </style>

    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
            });
        });

        $(document).ready(function() {
            $("#show_hide_confirm_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_confirm_password input').attr("type") == "text"){
                    $('#show_hide_confirm_password input').attr('type', 'password');
                    $('#show_hide_confirm_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_confirm_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_confirm_password input').attr("type") == "password"){
                    $('#show_hide_confirm_password input').attr('type', 'text');
                    $('#show_hide_confirm_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_confirm_password i').addClass( "fa-eye" );
                }
            });
        });
    </script>
@endsection
