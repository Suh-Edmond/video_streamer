@extends('layouts.dashboard')

@section('title', __('messages.manage_users'))

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
@endsection
