@extends('layouts.dashboard')

@section('title', 'My Files')


@section('layoutToggle')
    <div>
        <span>View: </span>
        <div class="btn-group" role="group" aria-label="view">
            <button onclick="changeLayout('grid')" type="button" class="btn border  {{$data['gridView'] ? ' bg-success text-white': ' bg-white'}}"><i
                    class="fas fa-th-large"></i></button>
            <button onclick="changeLayout('list')" type="button" class="btn border  {{$data['gridView'] ? ' bg-white': ' bg-success text-white'}}"><i class="fa fa-list"></i></button>
        </div>
    </div>
@endsection

@section('filters')
    <div class="dropdown">
        <button class="btn border btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            All files
        </button>
        <ul class="dropdown-menu shadow py-3 bg-white">
            <li><a class="dropdown-item date_filter" onclick="filterBy('')">All files</a></li>
            <li><a onclick="filterBy('IMAGE')" class="dropdown-item date_filter">Images only</a></li>
            <li><a onclick="filterBy('VIDEO')" class="dropdown-item date_filter">Videos only</a></li>
        </ul>
    </div>
@endsection

@section('sort')
    <div class="dropdown">
        <button class="btn border btn-outline-success" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="d-flex gap-1 align-items-center">
                <i class="fa-solid fa-filter"></i><span>Sort:</span>
            </div>
        </button>
        <ul class="dropdown-menu bg-white">
            <li> <a onclick="sortBy('DATE_DESC')" class="dropdown-item date_filter">Newest First</a></li>
            <li><a onclick="sortBy('DATE_ASC')" class="dropdown-item date_filter">Oldest First</a></li>
            <li><a onclick="sortBy('NAME')" class="dropdown-item date_filter">Name</a></li>
        </ul>
    </div>
@endsection

@section('action')
    <button class="btn btn-success shadow py-2 px-3 d-flex align-items-center justify-content-center gap-2 dropdown-toggle" type="button" id="dropdownMenuButton1"
            data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fa fa-add"></i><span>Upload New Files</span>
    </button>
    <ul class="dropdown-menu bg-white" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item upload" href="#" data-bs-toggle="modal" data-bs-target="#uploadImageModal">Upload
                Images</a></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#uploadVideoModal">Upload
                Videos</a></li>
    </ul>
@endsection

@section('dashboard-content')
    @if ($data['gridView'])
        <div class="row" style="margin-left: -1.25rem">
            @forelse ($data['items'] as $item)
                <div class="col-12 col-md-6 col-lg-2 mb-2 p-3">
                    <div class="shadow bg-white rounded position-relative pb-4">
                        <div class="dropdown bg-white rounded shadow position-absolute top-0 end-0" style="z-index: 10">
                            <button class="btn border btn-outline-success" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item date_filter" type="button" data-bs-toggle="modal"
                                        data-bs-target="#propertiesModal" onclick="showProperties({{ $item }})">
                                        <i class="fa-solid fa-circle-info"></i>&nbsp;Properties
                                    </a></li>
                                <li>
                                    <a class="dropdown-item date_filter" type="button" onclick="generateQRcode({{$item}})">
                                        <i class="fa-regular fa-share-from-square"></i>&nbsp;Share
                                    </a>
                                </li>
                               @if($item->file_type == 'VIDEO')
                                    <li>
                                        <a class="dropdown-item date_filter" type="button" data-bs-toggle="modal"  data-bs-target={{'#streamVideoModal'.str($item->id)}}>
                                            <i class="fa-solid fa-play"></i>&nbsp;Play Video
                                        </a>
                                    </li>
                               @endif
                                <li>
                                    <a class="btn"  href="{{route('delete_file', ['id' => $item->id])}}" onclick="deleteFile({{$item}})">
                                        <i class="fa-solid fa-trash-can text-danger"></i>&nbsp;Delete
                                    </a>

                                    <form id="delete-form" action="{{ route('delete_file', ['id' => $item->id]) }}"
                                          method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>


                        <div class="d-flex flex-column ">
                            @if($item->file_type ==  \App\Constant\FileType::IMAGE)
                                <img class="w-full thumbnail" src={{ asset($item->getFilePath($item->id, $item->file_type)) }} alt={{$item->name}}>
                            @else
                                <button data-bs-toggle="modal"  data-bs-target={{'#streamVideoModal'.str($item->id)}} class="btn thumbnail" style="font-size: 4rem">
                                    <i class="fa-solid fa-play shadow rounded-circle pe-4 ps-5 py-4"></i>
                                </button>
                                {{-- <img class="thumbnail w-full" src={{ asset('assets/images/bg_video.png') }} alt={{$item->name}}> --}}
                            @endif

                            <div class=" pt-4 text-wrap px-3 text-muted text-xl text-break">{{ $item->name }}</div>
                        </div>
                    </div>
                </div>

                <!-------------------------------------------------VIDEO STREAM MODAL-------------------------------------------->
                @if($item->file_type == \App\Constant\FileType::VIDEO)
                    <div class="modal fade" id={{'streamVideoModal'.str($item->id)}} tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content m-3">
                                <div class="modal-header">
                                    <h5 class="modal-title file_label" id="exampleModalLabel">Playing {{$item->name}}</h5>
                                    <button type="button" class="btn-close"   data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex justify-content-center">
                                    <video width="600" height="350" controls  controlsList="nodownload" oncontextmenu="return false;">
                                        <source src="{{asset($item->getFilePath($item->id, $item->file_type))}}" type="video/mp4" id="video">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!------------------------------------------------END OF VIDEO MODAL---------------------------------------------->
            @empty
                <p>No items</p>
            @endforelse

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
                                    <a class="page-link" href="{{route('files', ['page' => $i])}}">{{$i}}</a>
                                </li>
                            @endfor
                            <li class="{{$data['items']->currentPage() == $data['items']->lastPage() ? 'page-item disabled': 'page-item'}}">
                                <a class="page-link" href="{{route('files', ['page' => $data['items']->currentPage() + 1])}}">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
        </div>
    @else
        <div class="pt-3">
            <table class="table table-striped">
                @if (count($data['items']) !== 0)
                    <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>File Type</th>
                    <th></th>
                    </tr>
                @endif

                @forelse ($data['items'] as $item)
                    <tr scope="row">
                        <td class="py-2">
                            <div class="text-muted d-flex justify-content-center align-items-center"
                                >
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
                                <button class="btn border btn-outline-success" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item date_filter" type="button" data-bs-toggle="modal"
                                            data-bs-target="#propertiesModal"
                                            onclick="showProperties({{ $item }})">
                                            <i class="fa-solid fa-circle-info"></i>&nbsp;Properties
                                        </a></li>
                                    <li>
                                        <a class="dropdown-item date_filter"   onclick="generateQRcode({{$item}})">
                                            <i class="fa-regular fa-share-from-square"></i>&nbsp;Share
                                        </a>
                                    </li>
                                    @if($item->file_type == 'VIDEO')
                                        <li>
                                            <a class="dropdown-item date_filter" type="button" data-bs-toggle="modal" data-bs-target="#streamVideoModal">
                                                <i class="fa-solid fa-play"></i>&nbsp;Play Video
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a class="btn"  href="{{route('delete_file', ['id' => $item->id])}}" onclick="deleteFile({{$item}})">
                                            <i class="fa-solid fa-trash-can text-danger"></i>&nbsp;Delete
                                        </a>

                                        <form id="delete-form" action="{{ route('delete_file', ['id' => $item->id]) }}"
                                              method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <!-------------------------------------------------VIDEO STREAM MODAL-------------------------------------------->
                    @if($item->file_type == \App\Constant\FileType::VIDEO)
                        <div class="modal fade" id="streamVideoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content m-3">
                                    <div class="modal-header">
                                        <h5 class="modal-title file_label" id="exampleModalLabel">Playing {{$item->name}} </h5>
                                        <button type="button" class="btn-close"   data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body my-3 d-flex justify-content-center">
                                        <video src="{{route('get_stream_video', ['path' => $item->getFilePath($item->id, $item->file_type)])}}" width="600" height="350" controls  controlsList="nodownload"
                                               oncontextmenu="return false;" id="video" type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!------------------------------------------------END OF VIDEO MODAL---------------------------------------------->
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
                                <a class="page-link" href="{{route('files', ['page' => $i])}}">{{$i}}</a>
                            </li>
                        @endfor
                        <li class="{{$data['items']->currentPage() == $data['items']->lastPage() ? 'page-item disabled': 'page-item'}}">
                            <a class="page-link" href="{{route('files', ['page' => $data['items']->currentPage() + 1])}}">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    @endif

    <!----------------------------------------QR CODE MODAL---------------------------------------------------->
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
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-md" aria-describedby="button-addon2" disabled id="link">
                            <button class="btn btn-success" type="button" id="copy"
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
    <!-----------------------------------------END OF QR CODE MODAL----------------------------------------------->

    <!----------------------------------------------------------------PROPERTIES MODAL----------------------------------->
    <div class="modal fade" id="propertiesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content m-3">
                <div class="modal-header">
                    <h5 class="modal-title file_label" id="exampleModalLabel">File Properties</h5>
                    <button type="button" class="btn-close"   data-bs-dismiss="modal" aria-label="Close"></button>
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
    <!-------------------------------------------------------------END OF PROPERTIES MODAL-------------------------->

    <!----------------------UPLOAD IMAGE MODAL------------------------------------------>
    <div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadImageModalLabel">Upload Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-2">
                    <div class="row row-gap-2 m-3">
                        <img id="image" src="{{asset('assets/images/bg_transparent.jpg')}}" class="img_upload" width="160px" height="160px">
                    </div>
                    <div class="row row-cols-1 mt-3 mx-3 mb-3">
                        <form action="{{ route('upload_files') }}" method="POST" enctype="multipart/form-data" id="fileUploadForm">
                            @csrf
                            <input type="file" name="image" accept="image/*" class="form-control image_field @error('image') is-invalid @enderror">

                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="progress mt-3" id="upload-progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>

                            <div class="my-3 d-flex justify-content-center">
                                <button class="btn btn-success w-100" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----------------------END OF UPLOAD IMAGE MODAL----------------------------------->

    <!----------------------UPLOAD VIDEO MODAL------------------------------------------>
    <div class="modal fade" id="uploadVideoModal" tabindex="-1" aria-labelledby="uploadVideoModalLabel" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadVideoModalLabel">Upload Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-2">
                    <div class="row row-cols-1 mt-3 mx-3 mb-3">
                        <form action="{{ route('upload_video_files') }}" method="POST" enctype="multipart/form-data" id="fileUploadForm">
                            @csrf
                            <input type="file" name="video" accept="video/*" class="form-control @error('video') is-invalid @enderror" >

                            @error('video')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="progress mt-3">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>

                            <div class="my-3 d-flex justify-content-center">
                                <button class="btn btn-success w-100" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----------------------END OF VIDEO IMAGE MODAL----------------------------------->


    <style>
        .dropdown-menu > dropdown-item:active {
            background-color: #5cb85c;
            color: white;
        }
        .dropdown-menu > li > a:active {
            background-color: #5cb85c;
            color: white;
        }
        .date_filter {
            cursor: pointer;
        }
        .text-xl {

        }
        .thumbnail {
            height: 180px;
        }

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

    <script>
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var $shareModal = $('#shareModal');
        let link = '';
        let layout = 'grid';
        var $modal = $('#uploadImageModal');
        var image = document.getElementById('image');

        $(".image_field").on("change", function(e){
            var files = e.target.files;
            var done = function (url) {
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;
            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });


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

        let showProperties = function (item){

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

        $(document).ready(function() {
            let urlParams = new URLSearchParams(location.search);
            filter = urlParams.get('filter') || '';
            sort = urlParams.get('sort') || '';
        })

        let deleteFile = function(file) {
            let id = file.id
            $.ajax({
                url: "{{ route('delete_file', '__ID__') }}".replace('__ID__', id),
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                success: function(data) {
                    location.reload()
                },
                error: function(error) {
                }
            })
        }

        $(function () {
            $(document).ready(function () {

                 $('#fileUploadForm').ajaxForm({
                    beforeSend: function () {
                        var percentage = '0';
                    },
                    uploadProgress: function (event, position, total, percentComplete) {

                        var percentage = percentComplete;
                        $('.progress .progress-bar').css("width", percentage+'%', function() {
                            return $(this).attr("aria-valuenow", percentage) + "%";
                        })

                    },
                    complete: function (xhr) {
                        $modal.modal('hide');
                        window.location.reload();
                    }
                });
            });
        });
     </script>
@endsection
