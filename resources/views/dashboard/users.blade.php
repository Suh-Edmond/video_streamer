@extends('layouts.dashboard')

@section('title', 'Manage Users')

@section('dashboard-content')
    <div style="overflow-x: scroll;">
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Role</th>
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

                    <td class="py-2">
                        {{ $user->status }}
                    </td>

                    <td class="py-2">
                        {{ $user->role }}
                    </td>

                    <td class="py-2">

                        @if ($user->id != Auth::user()->id)
                            <div class="dropdown">
                                <button class="btn border btn-outline-secondary" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <ul class="dropdown-menu bg-white">
                                    @if ($user->status == \App\Constant\UserStatus::ACTIVE)
                                        <li>
                                            <a href="{{ route('users.block', ['id' => $user->id]) }}"
                                                onclick="event.preventDefault();
                                document.getElementById('block-form').submit();"
                                                class="dropdown-item d-flex gap-2 align-items-center"> <i
                                                    class="fa fa-close"></i> <span>Block</span></a>
                                            <form id="block-form" action="{{ route('users.block', ['id' => $user->id]) }}"
                                                method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    @endif
                                    @if ($user->status == \App\Constant\UserStatus::IN_ACTIVE)
                                        <li>
                                            <a href="{{ route('users.unblock', ['id' => $user->id]) }}"
                                                onclick="event.preventDefault();
                                         document.getElementById('delete-form').submit();"
                                                class="dropdown-item d-flex gap-2 align-items-center"><i
                                                    class="fas fa-close"></i><span class="text-danger">Unblock</span></a>
                                            </a>

                                            <form id="delete-form"
                                                action="{{ route('users.unblock', ['id' => $user->id]) }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    @endif

                                    <li>
                                        <a href="{{ route('users.delete', ['id' => $user->id]) }}"
                                            onclick="event.preventDefault();
                                         document.getElementById('delete-form').submit();"
                                            class="dropdown-item d-flex gap-2 align-items-center text-danger"><i
                                                class="fas fa-trash-can"></i><span class="text-danger">Delete</span></a>
                                        </a>

                                        <form id="delete-form" action="{{ route('users.delete', ['id' => $user->id]) }}"
                                            method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>



                                </ul>
                            </div>
                        @endif
                    </td>
                </tr>
            @empty
                <p>No items</p>
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
            color: darkgreen;
        }

        .pagination > li > a:focus,
        .pagination > li > a:hover,
        .pagination > li > span:focus,
        .pagination > li > span:hover
        {
            color: darkgreen;
            background-color: #eee;
            border-color: #ddd;
        }

        .pagination > .active > a
        {
            color: white;
            background-color: darkgreen;
            border: solid 1px darkgreen;
        }

        .pagination > .active > a:hover
        {
            background-color: darkgreen;
            border: solid 1px darkgreen;
        }
    </style>
@endsection
