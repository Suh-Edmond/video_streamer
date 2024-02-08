@extends('layouts.dashboard')

@section('title', 'My Files')
@section('action', 'Upload New Files')

@section('dashboard-content')
    @if ($data['gridView'])
        <div class="row gap-auto gap-4">
            @forelse ($data['items'] as $item)
                <div class="col-12 col-md-5 col-lg-2 mb-2 bg-white rounded">
                    <div class="d-flex flex-column align-items-center">
                        <div class="text-center  py-4">{{ $item->name }}</div>

                        <img class="h-2 w-full" src={{ asset($item->getFilePath($item->id))}} alt="" width="150px" height="150px">

                        <div class="py-3">
                            <button class="btn " title="Generate QR Code"><i
                                    class="fa-regular fa-share-from-square"></i></button>
                            <button class="btn text-danger" title="Delete">
                                <a href="{{route('delete_file', ['id' => $item->id])}}" onclick="event.preventDefault();
                                         document.getElementById('delete-form').submit();">
                                    <i class="fa-solid fa-trash-can text-danger"></i>
                                </a>

                                <form id="delete-form" action="{{ route('delete_file', ['id' => $item->id]) }}"
                                      method="POST" class="d-none">
                                    @csrf

                                </form>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <p>No items</p>
            @endforelse
        </div>
    @else
        <div>
            <table class="table table-striped">
                @forelse ($data['items'] as $item)
                    <tr scope="row">
                        <td class="py-2">
                            <div class="rounded-circle border d-flex justify-content-center align-items-center"
                                style="width: 30px; height: 30px">
                                {{ $loop->index + 1 }}
                            </div>
                        </td>
                        <td class="py-2">
                            Serkwi Bruno
                        </td>

                        <td class="py-2">
                            USER
                        </td>

                        <td class="py-2">
                            <div class="dropdown">
                                <button class="btn border btn-outline-secondary" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item d-flex gap-2 align-items-center" href="#"> <i
                                                class="fa fa-close"></i> <span>Block</span></a></li>
                                    <li><a class="dropdown-item d-flex gap-2 align-items-center" href="#"><i
                                                class="fas fa-trash-can"></i><span class="text-danger">Delete</span></a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @empty
                    <p>No items</p>
                @endforelse
            </table>
        </div>
    @endif
@endsection
