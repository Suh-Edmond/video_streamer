@extends('layouts.dashboard')

@section('title', 'My Files')
@section('action')
    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="fa fa-add"></i>Upload New Files
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#uploadImageModal">Upload
                Images</a></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#uploadVideoModal">Upload
                Videos</a></li>
    </ul>
@endsection

@section('layoutToggle')
    <div>
        <span>View: </span>
        <div class="btn-group" role="group" aria-label="view">
            <button onclick="changeLayout('grid')" type="button" class="btn border"><i
                    class="fas fa-th-large"></i></button>
            <button onclick="changeLayout('list')" type="button" class="btn border"><i class="fa fa-list"></i></button>
        </div>
    </div>
@endsection

@section('filters')
    <div class="dropdown">
        <button class="btn border btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            All files
        </button>
        <ul class="dropdown-menu">
            <li><button class="dropdown-item" onclick="filterBy('')">All files</button></li>
            <li><button onclick="filterBy('IMAGE')" class="dropdown-item">Images only</button></li>
            <li><button onclick="filterBy('VIDEO')" class="dropdown-item">Videos only</button></li>
        </ul>
    </div>
@endsection

@section('sort')
    <div class="dropdown">
        <button class="btn border btn-outline-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="d-flex gap-1 align-items-center">
                <i class="fa-solid fa-filter"></i><span>Sort:</span>
            </div>
        </button>
        <ul class="dropdown-menu">
            <li> <a onclick="sortBy('DATE_DESC')" class="dropdown-item" href="#">Newest First</a></li>
            <li><a onclick="sortBy('DATE_ASC')" class="dropdown-item" href="#">Oldest First</a></li>
            <li><a onclick="sortBy('NAME')" class="dropdown-item" href="#">Name</a></li>
        </ul>
    </div>
@endsection

@section('action')
    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="fa fa-add"></i>Upload New Files
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#uploadImageModal">Upload
                Images</a></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#uploadVideoModal">Upload
                Videos</a></li>
    </ul>
@endsection

@section('dashboard-content')
    @if ($data['gridView'])
        <div class="row gap-auto gap-4">
            @forelse ($data['items'] as $item)
                <div class="col-12 col-md-5 col-lg-2 mb-2 pb-4 bg-white rounded position-relative">
                    <div class="dropdown bg-white position-absolute top-0 end-0" style="z-index: 10">
                        <button class="btn border btn-outline-secondary" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><button class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#propertiesModal" onclick="showProperties({{ $item }})">
                                    <i class="fa-solid fa-circle-info"></i>&nbsp; Properties
                                </button></li>
                            <li>
                                <button class="btn shareBtn-{{ $item->id }}"
                                    onclick="generateQRcode({{ $item }})">
                                    <i class="fa-regular fa-share-from-square"></i>&nbsp; Share
                                </button>
                            </li>
                            <li>
                                <button class="btn text-danger">
                                    <a href="{{ route('delete_file', ['id' => $item->id]) }}"
                                        onclick="event.preventDefault();
                                         document.getElementById('delete-form').submit();">
                                        <i class="fa-solid fa-trash-can text-danger"></i>
                                    </a>&nbsp; Delete

                                    <form id="delete-form" action="{{ route('delete_file', ['id' => $item->id]) }}"
                                        method="POST" class="d-none">
                                        @csrf

                                    </form>
                                </button>
                            </li>
                        </ul>
                    </div>
                    @if ($item->file_type === 'VIDEO')
                        <div
                            class="h-100 w-100 d-flex justify-content-center align-items-center position-absolute start-0 top-0 play-video-wrapper">
                            <button class="btn" onclick="streamVideo({{ $item }})">
                                <i style="font-size: 72px" class="fa-solid fa-play"></i>
                            </button>
                        </div>
                    @endif

                    <div class="d-flex flex-column align-items-center">
                        <img class="h-2 w-full" src={{ asset($item->getFilePath($item->id)) }} alt=""
                            width="150px" height="150px">

                        <div class="text-center  py-2">{{ $item->name }}</div>
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
                            {{ $item->name }}
                        </td>

                        <td class="py-2">
                            {{ $item->file_type }}
                        </td>

                        <td class="py-2">
                            <div class="dropdown">
                                <button class="btn border btn-outline-secondary" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><button class="dropdown-item" type="button" data-bs-toggle="modal"
                                            data-bs-target="#propertiesModal"
                                            onclick="showProperties({{ $item }})">
                                            <i class="fa-solid fa-circle-info"></i>&nbsp; Properties
                                        </button></li>
                                    {{--                            <li><button class="dropdown-item" type="button"  > --}}
                                    {{--                                    <i class="fa-solid fa-crop"></i>&nbsp; Crop --}}
                                    {{--                                </button></li> --}}
                                    <li>
                                        <button class="btn shareBtn-{{ $item->id }}"
                                            onclick="generateQRcode({{ $item }})">
                                            <i class="fa-regular fa-share-from-square"></i>&nbsp; Share
                                        </button>
                                    </li>
                                    <li>
                                        <button class="btn text-danger">
                                            <a href="{{ route('delete_file', ['id' => $item->id]) }}"
                                                onclick="event.preventDefault();
                                         document.getElementById('delete-form').submit();">
                                                <i class="fa-solid fa-trash-can text-danger"></i>
                                            </a>&nbsp; Delete

                                            <form id="delete-form"
                                                action="{{ route('delete_file', ['id' => $item->id]) }}" method="POST"
                                                class="d-none">
                                                @csrf

                                            </form>
                                        </button>
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

    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content m-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Copy the QR Code link to share this file</h5>
                    <button type="button" class="btn-close" onclick="closeModal()" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-gap-0 d-flex justify-content-sm-around">
                        <div class="col-8 col-sm-8 col-md-8">
                            <input class="form-control form-control-md" type="text" disabled id="link">
                        </div>
                        <div class="col-2 col-md-2 col-sm-2">
                            <button type="button" class="btn btn-primary" id="copy"
                                onclick="copyToClipboard()">Copy</button>
                        </div>
                    </div>
                    <div class="divider my-3">OR</div>
                    <div class="d-flex justify-content-center mt-3 mb-3">
                        <button type="button" class="btn btn-success w-100" onclick="shareViaWhatsapp()"
                            data-bs-dismiss="modal">Share via WhatsApp</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="propertiesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content m-3">
                <div class="modal-header">
                    <h5 class="modal-title file_label" id="exampleModalLabel">File Properties</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mb-2">
                    <div class="my-2">
                        <label><span class="file_label">Name</span>:&nbsp;<span class="item_name"></span></label>
                    </div>
                    <div class="my-2">
                        <label><span class="file_label">Type</span>:&nbsp;<span class="item_type"></span></label>
                    </div>
                    <div class="my-2">
                        <label><span class="file_label">Size</span>:&nbsp;<span class="item_size"></span>bytes</label>
                    </div>
                    <div class="my-2">
                        <label><span class="file_label">Created</span>:&nbsp;<span class="item_created"></span></label>
                    </div>
                    <div class="my-2">
                        <label><span class="file_label">Modified</span>:&nbsp;<span class="item_modified"></span></label>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .file_label {
            font-weight: bold;
        }

        .link {
            font-weight: bold;
        }

        .divider {
            font-size: 20px;
            display: flex;
            align-items: center;
        }

        .divider::before,
        .divider::after {
            flex: 1;
            content: '';
            padding: 1px;
            background-color: black;
            margin: 5px;
        }
    </style>

    <script>
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var $shareModal = $('#shareModal');
        let link = '';
        let layout = 'grid';

        let generateQRcode = function(data) {
            let id = data.id;
            let route = "{{ route('share_link', '__ID__') }}".replace('__ID__', id);
            $.ajax({
                method: 'GET',
                url: route,
                success: function(response) {
                    $('#link').val(response.data)
                    link = response.data
                    $shareModal.modal('show');
                    console.log(link)
                }
            })
        }
        let closeModal = function() {
            $('#copy').html('Copy');
            $('#link').val('')
        }

        let copyToClipboard = function() {
            navigator.clipboard.writeText(($('#link').val()))
            $('#copy').html('Copied')
        }

        let shareViaWhatsapp = function() {
            window.open('https://api.whatsapp.com/send?phone=&text=' + encodeURIComponent(link))
        }

        let deleteFile = function(file) {
            let id = file.id
            $.ajax({
                url: "{{ route('delete_file', '__ID__') }}".replace('__ID__', id),
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                success: function(data) {
                    location.reload()
                },
                error: function(error) {
                    console.log(error)
                }
            })
        }


        let showProperties = function(item) {
            console.log(item)
            $('.item_name').text(item.name)
            $('.item_type').text(item.file_type)
            $('.item_created').text(new Date(item.created_at).toGMTString())
            $('.item_modified').text(new Date(item.updated_at).toGMTString())
            $('.item_size').text(item.size)
        }

        let applyParams = function(sort, filtr, layt) {
            let url = new URL(location.href);
            let searchParams = new URLSearchParams(url.search);
            searchParams.set('filter', filtr);
            searchParams.set('sort', sort);
            searchParams.set('layout', layt);
            url.search = searchParams.toString();

            location.href = url
        }

        let filterBy = function(newFilter) {
            filter = newFilter;
            applyParams(sort, newFilter, layout);
        }

        let sortBy = function(newSort) {
            sort = newSort;
            applyParams(newSort, filter, layout);
        }

        let changeLayout = function(newLayout) {
            layout = newLayout;
            applyParams(sort, filter, layout);
        }

        let streamVideo = function(file) {

            alert('Streaming '+file.name)
        }

        $(document).ready(function() {
            let urlParams = new URLSearchParams(location.search);
            filter = urlParams.get('filter') || '';
            sort = urlParams.get('sort') || '';
        })
    </script>
@endsection
