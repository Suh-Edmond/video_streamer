@extends('layouts.auth')

@section('content')
    <div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                <div class="my-4">
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">
                                    <span><i class="fa-solid fa-envelope"></i></span>
                                     <span class="fw-bold">{{__('messages.email')}}</span>
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
                                    <span class="fw-bold">{{__('messages.password')}}</span>
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
                                <button type="submit" class="btn btn-success w-100 fw-bold" id="loginBtn" onclick="submitLogin()">
                                    {{ __('messages.continue') }} <span class="p-1"><i class="fa-solid fa-arrow-right"></i></span>
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

        let submitLogin = function (){
            $('#loginBtn').text('')
            $("#loginBtn").prepend('<i class="fa fa-spinner fa-spin"></i>');
        }



    </script>
@endsection
