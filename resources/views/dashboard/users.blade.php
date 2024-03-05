@extends('layouts.dashboard')

@section('title', __('messages.manage_users'))

@section('filters')
    <div class="dropdown">
        <button class="btn border btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
            {{__('messages.allUsers')}}
        </button>
        <ul class="dropdown-menu shadow py-3 bg-white">
            <li><a class="dropdown-item date_filter" onclick="filterBy('')">{{__('messages.allUsers')}}</a></li>
            <li><a onclick="filterBy('ACTIVE')" class="dropdown-item date_filter">{{__('messages.active')}}</a></li>
            <li><a onclick="filterBy('IN_ACTIVE')" class="dropdown-item date_filter">{{__('messages.inactive')}}</a></li>
        </ul>
    </div>
@endsection

@section('sort')
    <div class="dropdown">
        <button class="btn border btn-outline-success" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="d-flex gap-1 align-items-center">
                <i class="fa-solid fa-filter"></i><span>{{__('messages.sort')}}:</span>
            </div>
        </button>
        <ul class="dropdown-menu bg-white">
            <li> <a onclick="sortBy('DATE_DESC')" class="dropdown-item date_filter">{{__('messages.newestFirst')}}</a></li>
            <li><a onclick="sortBy('DATE_ASC')" class="dropdown-item date_filter">{{__('messages.oldestFirst')}}</a></li>
            <li><a onclick="sortBy('NAME')" class="dropdown-item date_filter">{{__('messages.name')}}</a></li>
        </ul>
    </div>
@endsection

@section('dashboard-content')
    <div style="overflow-x: scroll;">
        <table class="table table-striped">
            <tr>
                <th>{{__('messages.sn')}}</th>
                <th>{{__('messages.name')}}</th>
                <th>{{__('messages.email')}}</th>
                <th>{{__('messages.status')}}</th>
                <th>{{__('messages.role')}}</th>
                <th></th>
            </tr>
            @forelse ($data['items'] as $user)
                <tr scope="row">
                    <td class="py-2">
                        <div class="text-muted">
                            {{ $loop->index + 1 }}
                        </div>
                    </td>
                    <td class="py-2">
                        {{ $user->name }}
                    </td>

                    <td class="py-2">
                        {{ $user->email }}
                    </td>

                    @if($user->status == \App\Constant\UserStatus::ACTIVE)
                        <td class="py-2 text-success">
                            {{ $user->status }}
                        </td>
                    @else
                        <td class="py-2 text-danger">
                            {{ $user->status }}
                        </td>
                    @endif

                    <td class="py-2">
                        {{ $user->role }}
                    </td>

                    <td class="py-2">
                        @if ($user->role !== 'ADMIN' )
                            <div class="dropdown">
                                <button class="btn border btn-outline-success" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <ul class="dropdown-menu bg-white">
                                    @if ($user->status == \App\Constant\UserStatus::ACTIVE)
                                        <li>
                                            <a href="{{ route('users.block', ['user' => $user]) }}"
                                                class="dropdown-item d-flex gap-2 align-items-center"> <i
                                                    class="fa fa-close"></i> <span class="text-black">{{__('messages.block')}}</span></a>
                                        </li>
                                    @endif
                                    @if ($user->status == \App\Constant\UserStatus::IN_ACTIVE)
                                        <li>
                                            <a href="{{ route('users.unblock', ['user' => $user]) }}"
                                                class="dropdown-item d-flex gap-2 align-items-center"><i
                                                    class="fas fa-close"></i><span class="text-black">{{__('messages.unBlock')}}</span></a>
                                            </a>
                                        </li>
                                    @endif

                                    <li>
                                        <a href="{{ route('users.delete', ['user' => $user]) }}"
                                            class="dropdown-item d-flex gap-2 align-items-center text-danger"><i
                                                class="fas fa-trash-can"></i><span class="text-danger">{{__('messages.delete')}}</span></a>
                                        </a>

                                    </li>
                                </ul>
                            </div>
                        @endif
                    </td>
                </tr>
            @empty
                <p>{{__('messages.notItems')}}</p>
            @endforelse
        </table>

            <div class="d-flex justify-content-sm-end">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li   class="{{$data['items']->currentPage() == 1 ? 'page-item disabled':'page-item'}}">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @for($i = 1; $i <= $data['items']->lastPage(); $i++)
                            <li class="{{$data['items']->currentPage() == $i ? 'page-item active':'page-item'}}">
                                <a class="page-link" href="{{route('users', ['page' => $i])}}">{{$i}}</a>
                            </li>
                        @endfor
                        <li class="{{$data['items']->currentPage() == $data['items']->lastPage() ? 'page-item disabled': 'page-item'}}">
                            <a class="page-link" href="{{route('users', ['page' => $data['items']->currentPage() + 1])}}">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
    </div>
    <style>
        .pagination > li > a
        {
            background-color: white;
            color: #198754;
        }

        .pagination > li > a:focus,
        .pagination > li > a:hover,
        .pagination > li > span:focus,
        .pagination > li > span:hover
        {
            color: #198754;
            background-color: #eee;
            border-color: #ddd;
        }

        .pagination > .active > a
        {
            color: white;
            background-color: #198754;
            border: solid 1px #198754;
        }

        .pagination > .active > a:hover
        {
            background-color: #198754;
            border: solid 1px #198754;
        }

        .dropdown-menu > dropdown-item:active {
            background-color: #198754;
            color: white;
        }
        .dropdown-menu > li > a:active {
            background-color: #198754;
            color: white;
        }
    </style>

    <script>
        let applyParams = function(sort, filtr) {
            let url = new URL(location.href);
            let searchParams = new URLSearchParams(url.search);
            searchParams.set('filter', filtr);
            searchParams.set('sort', sort);
            url.search = searchParams.toString();

            location.href = url
        }

        let filterBy = function(newFilter) {
            filter = newFilter;
            applyParams(sort, newFilter);
        }

        let sortBy = function(newSort) {
            sort = newSort;
            applyParams(newSort, filter);
        }

        $(document).ready(function() {
            let urlParams = new URLSearchParams(location.search);
            filter = urlParams.get('filter') || '';
            sort = urlParams.get('sort') || '';

        })
    </script>
@endsection
