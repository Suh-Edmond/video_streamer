<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>File Manager</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0;
            font-family: 'Nunito', sans-serif;
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg,
        video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity))
        }


        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }
        .nav-pills > a:hover {
            color: #198754;
        }
        .nav-pills >  a {
            color: #198754;
        }

        .img-bg {
            background-color: rgba(25,135,84, .5);
            position: absolute;
            height: 100%;
            width: 100%;
            z-index: 1;
        }
        .nav-link.active {
            background: #198754 !important;
        }

        .lang {
            position: absolute;
            left: 96%;
        }
        .nav-item > .nav-link {
            text-decoration: none;
            color: black;
        }

        .dropdown-menu > .dropdown-item:active {
            background-color: green;
            color: white;
        }

    </style>


</head>

<body class="antialiased">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    <div class="d-flex px-4 px-lg-0" style="height: 100vh">
        <div class="col d-none d-lg-block d-flex justify-content-center align-items-center">
            <div class="position-relative">
                <div class="img-bg"></div>
                <img src="{{ asset('assets/images/bg_auth2.jpg') }}" alt="background image"
                class="rounded img-flud" width="100%" height="100%">
            </div>
        </div>
        <div class="lang">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown px-2">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ session()->get('locale') !== null ? session()->get('locale'): 'en' }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end bg-white" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('change_language_guest', ['locale' => "en"]) }}">{{ __('messages.english') }}</a>
                        <a class="dropdown-item" href="{{ route('change_language_guest', ['locale' => 'fr']) }}">{{ __('messages.french') }}</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col d-flex flex-column bg-white h-100 justify-content-center align-items-stretch align-items-lg-center">

            <div class="col-12 col-lg-6">
                <nav class="nav nav-pills nav-fill nav-justified" id="pills-tab" role="tablist">
                    <a class="nav-link fw-bold" id="pills-login-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-login" role="tab" aria-controls="pills-login"
                        aria-selected="true">{{__('messages.login')}}</a>
                </nav>
                <div class="border p-4 py-lg-4 rounded">
                    @if(count($errors) > 0)
                        @foreach( $errors->all() as $message )
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                 {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endforeach
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>


</body>

</html>
