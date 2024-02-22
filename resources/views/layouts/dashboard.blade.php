@extends('layouts.app', ['admin' => $data['admin']])

@section('content')
    <div class="py-3 px-lg-5">
        <div class="flex flex-column mx-auto">

            @if(Auth::user()->status == \App\Constant\UserStatus::ACTIVE)
                <div class="d-flex gap-3 gap-lg-0 rounded-lg flex-column flex-md-row align-items-md-stretch p-3 px-2 py-lg-5 px-lg-5 bgwhite border-bottom">
                    <div>
                        <h2 class="mb-4 h2" class="title">@yield('title')</h2>

                        @if ($data['filter'])
                            <div class="d-flex relative gap-2">
                                @yield('filters')
                                @yield('sort')
                            </div>
                        @endif
                    </div>

                    <div class="ms-md-auto d-flex flex-row-reverse flex-md-column justify-content-between align-items-md-end">
                        <div>
                            @yield('action')
                        </div>
                        @if ($data['filter'])
                            @yield('layoutToggle')
                        @endif
                    </div>
                </div>

                <div class="mt-5 px-2 files-grid">
                    @yield('dashboard-content')
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    Your account has been blocked. Please Contact the Administrator of the application for more info. <b>Email:
                        <span>
                        <a class="alert-link" href="mailto:{{$data['admin']->email}}">{{$data['admin']->email}}</a>
                    </span>
                    </b>
                </div>
            @endif

        </div>
    </div>

    <style>
        .mail_link {
            text-decoration: none;
            color: info;
        }
    </style>
@endsection

