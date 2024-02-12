@extends('layouts.app')

@section('content')
    <div class="py-3">
        <div class="flex flex-column mx-auto" style="width: 85%">
            <div class="d-flex shadow-lg rounded flex-column flex-md-row align-items-md-stretch py-5 px-5 bg-white">
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
        </div>
    </div>
@endsection

