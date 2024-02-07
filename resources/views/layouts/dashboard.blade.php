@extends('layouts.app')

@section('content')
    <div class="px-5 py-3">
        <div class="flex flex-column">
            <div class="d-flex flex-column flex-md-row align-items-md-stretch py-5 px-5 bg-white">
                <div>
                    <h2 class="mb-3">@yield('title')</h2>

                    @if ($data['filter'])
                        <div class="d-flex relative gap-2">
                            <div class="dropdown">
                                <button class="btn border btn-outline-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    All files
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">All files</a></li>
                                    <li><a class="dropdown-item" href="#">Images only</a></li>
                                    <li><a class="dropdown-item" href="#">Videos only</a></li>
                                </ul>
                            </div>

                            <div class="dropdown">
                                <button class="btn border btn-outline-secondary" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="d-flex gap-1 align-items-center">
                                        <i class="fa-solid fa-filter"></i><span>Sort:</span>
                                    </div>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Newest First</a></li>
                                    <li><a class="dropdown-item" href="#">Oldest First</a></li>
                                    <li><a class="dropdown-item" href="#">Name</a></li>
                                </ul>
                            </div>
                        </div>
                    @endif

                </div>

                <div class="ms-md-auto d-flex flex-row-reverse flex-md-column justify-content-between align-items-md-end">
                    <button class="btn btn-success"><i class="fa fa-add"></i> @yield('action')</button>
                    @if ($data['filter'])
                        <div>
                            <span>View: </span>
                            <div class="btn-group" role="group" aria-label="view">
                                <button type="button" class="btn border"><i
                                        class="fas fa-th-large"></i></button>
                                <button type="button" class="btn border"><i class="fa fa-list"></i></button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-5 px-2">
                @yield('dashboard-content')
            </div>
        </div>
    </div>
@endsection
