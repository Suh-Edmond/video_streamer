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

@section('action')
    <button class="btn btn-success shadow px-3 d-flex align-items-center justify-content-center gap-2" type="button" data-bs-toggle="modal"
            data-bs-target="#addUserModal" >
        <i class="fa fa-add"></i><span>{{__('messages.addUser')}}</span>
    </button>
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


    <!----------------------GENERATE LINK MODAL------------------------------------------>
    <div class="modal fade" id="addUserModal" data-bs-backdrop="static"  tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true"  data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header" style="padding-left:35px;padding-right: 35px;padding-top: 35px">
                    <h5 class="modal-title fw-bold" id="uploadVideoModalLabel">{{__('messages.addUserMsg')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
                </div>
                <div class="modal-body p-2">
                    <div class="row mx-4 alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="row row-cols-1 mt-3 mx-3 mb-3">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">
                                    <span><i class="fa-solid fa-user"></i></span>
                                    <span class="fw-bold">{{__('messages.name')}}</span>
                                </label>
                                <input class="name form-control form-control-md @error('name') is-invalid @enderror"
                                       type="text" name="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">
                                    <span><i class="fa-solid fa-envelope"></i></span>
                                    <span class="fw-bold">{{__('messages.email')}}</span>
                                </label>
                                <input class="email form-control form-control-md @error('email') is-invalid @enderror"
                                       type="email" name="email" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">
                                    <span><i class="fa-solid fa-lock"></i></span>
                                    <span class="fw-bold">{{__('messages.password')}}</span>
                                </label>
                                <div class="input-group"  id="show_hide_password">
                                    <input id="confirm_password" type="password"
                                           class="password form-control form-control-md @error('password') is-invalid @enderror"
                                           name="password" required aria-describedby="basic-addon2">
                                    <a class="input-group-text" id="basic-addon2"><i class="fa-solid fa-eye-slash"></i></a>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">
                                    <span><i class="fa-solid fa-lock"></i></span>
                                    <span class="fw-bold">{{__('messages.confirmPassword')}}</span>
                                </label>
                                <div class="input-group"  id="show_hide_confirm_password">
                                    <input id="password-confirm" type="password" class="confirm_password form-control form-control-md"
                                           name="password_confirmation" required aria-describedby="basic-addon2">
                                    <a class="input-group-text" id="basic-addon2"><i class="fa-solid fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
                            </div>

                            <div class="my-4 d-flex justify-content-end">
                                <button class="btn btn-success fw-bold" id="registerBtn" onclick="submitRegister()">
                                    {{ __('messages.save') }}
                                </button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----------------------END OF GENERATE LINK MODAL----------------------------------->


    <style>
        .date_filter {
            cursor: pointer;
        }
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
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var $modal = $('#addUserModal');


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

        let validateForm = function (){
            return $('.name').val() === "" || $('.email').val() === "" || $('.password').val() === "" || $('.confirm_password').val() === ""

        }

        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }

        let closeModal = function (){
            $modal.modal('hide')
            window.location.reload();
        }

        let submitRegister = function (){
            let payload = {
                "name" : $('.name').val(),
                "email" : $('.email').val(),
                "password" : $('.password').val(),
                "password_confirmation" : $('.confirm_password').val()
            }
            $('#registerBtn').text('')
            $("#registerBtn").prepend('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                method: 'POST',
                url: "{{route('create_account')}}",
                data: {_token: CSRF_TOKEN, 'data': payload},
                dataType: "json",
                success: function(response) {
                    if(response.status === "200"){
                        $modal.modal('hide');
                        window.location.reload();
                        toastr.success("User account created successfully");
                    }else {
                        printErrorMsg(response.error);
                        $('#registerBtn').text('Save')
                    }
                },
                error:function (error){
                    $("#registerBtn").find(".fa-spinner").remove();
                    $modal.modal('hide');

                }
            })

        }


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
