@extends('layouts.dashboard')

@section('title', 'Manage Users')
@section('action', 'Add User')

@section('dashboard-content')
    <div>
        <table class="table table-striped">
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Roles</th>
                <th></th>
            </tr>
            @forelse ($data['items'] as $user)
                <tr scope="row">
                    <td class="py-2">
                        <div class="rounded-circle border d-flex justify-content-center align-items-center"
                            style="width: 30px; height: 30px">
                            {{ $loop->index + 1 }}
                        </div>
                    </td>
                    <td class="py-2">
                        {{ $user->name }}
                    </td>

                    <td class="py-2">
                        {{ $user->role }}
                    </td>

                    <td class="py-2">
                        @if (Auth::user()->id != $user->id)
                            <div class="dropdown">
                                <button class="btn border btn-outline-secondary" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a onclick="event.preventDefault();
                                document.getElementById('block-form').submit();"
                                            class="dropdown-item d-flex gap-2 align-items-center"> <i
                                                class="fa fa-close"></i> <span>Block</span></a>
                                    </li>
                                    <li>
                                        <a onclick="event.preventDefault();
                                         document.getElementById('delete-form').submit();"
                                            class="dropdown-item d-flex gap-2 align-items-center"><i
                                                class="fas fa-trash-can"></i><span class="text-danger">Delete</span></a>
                                        </a>

                                        <form id="block-form" action="{{ route('users.block', ['id' => $user->id]) }}"
                                            method="POST" class="d-none">
                                            @csrf
                                        </form>

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
    </div>
@endsection
