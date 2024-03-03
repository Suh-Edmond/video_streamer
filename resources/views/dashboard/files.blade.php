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
                                        <i class="fa-solid fa-circle-info"></i><span style="padding-left: 20px">Properties</span>
                                    </a></li>
                                <li>
                                    <a class="dropdown-item date_filter" type="button" onclick="openSharedLink({{$item}})">
                                        <i class="fa-regular fa-share-from-square"></i><span style="padding-left: 20px">Share</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item date_filter" type="button" href="{{route('file_shared_links', ['fileId' => $item->id])}}">
                                        <i class="fa-solid fa-list-check"></i><span style="padding-left: 20px">Manage Shared Links</span>
                                    </a>
                                </li>
                               @if($item->file_type == 'VIDEO')
                                    <li>
                                        <a class="dropdown-item date_filter" type="button"  onclick="playVideo({{$item}})">
                                            <i class="fa-solid fa-play"></i><span style="padding-left: 20px">Play Video</span>
                                        </a>
                                    </li>
                               @endif
                                <li class="delete_file_btn">
                                    <a href="{{route('delete_file', ['file' => $item])}}" >
                                        <i class="fa-solid fa-trash-can text-danger"></i><span style="padding-left: 20px">Delete</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="d-flex flex-column ">
                            @if($item->file_type ==  \App\Constant\FileType::IMAGE)
                                <img class="w-full thumbnail" src={{ asset($item->getFilePath($item->id, $item->file_type)) }} alt={{$item->name}}>
                            @elseif($item->file_type == \App\Constant\FileType::VIDEO)
                                <button data-bs-toggle="modal"  onclick="playVideo({{$item}})" class="btn thumbnail" style="font-size: 4rem">
                                    <i class="fa-solid fa-play shadow rounded-circle pe-4 ps-5 py-4"></i>
                                </button>
                            @endif

                            <div class=" pt-4 text-wrap px-3 text-muted text-xl text-break">{{ $item->name }}</div>
                        </div>
                    </div>
                </div>
            @empty
                <p>No items</p>
            @endforelse

            @if($data['items']->lastPage() != $data['items']->currentPage())
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
            @endif
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
                                            <i class="fa-solid fa-circle-info"></i><span style="padding-left: 20px">Properties</span>
                                        </a></li>
                                    <li>
                                        <a class="dropdown-item date_filter"   onclick="openSharedLink({{$item}})">
                                            <i class="fa-regular fa-share-from-square"></i><span style="padding-left: 20px">Share</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item date_filter" type="button" href="{{route('file_shared_links', ['fileId' => $item->id])}}">
                                            <i class="fa-solid fa-list-check"></i><span style="padding-left: 20px">Manage Share Links</span>
                                        </a>
                                    </li>
                                    @if($item->file_type == 'VIDEO')
                                        <li>
                                            <a class="dropdown-item date_filter" type="button" onclick="playVideo({{$item}})">
                                                <i class="fa-solid fa-play"></i><span style="padding-left: 20px">Play Video</span>
                                            </a>
                                        </li>
                                    @endif
                                    <li class="delete_file_btn">
                                        <a href="{{route('delete_file', ['file' => $item])}}" >
                                            <i class="fa-solid fa-trash-can text-danger"></i><span style="padding-left: 20px">Delete</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                @empty
                    <p>No items</p>
                @endforelse
            </table>

            @if($data['items']->lastPage() != $data['items']->currentPage())
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
            @endif

        </div>
    @endif



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
                <div class="modal-header" style="padding-left:35px;padding-right: 35px;padding-top: 35px">
                    <h5 class="modal-title" id="uploadImageModalLabel">Upload Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-2">
                    <div class="row row-gap-2 m-3">
                        <img id="image" src="{{asset('assets/images/bg_transparent.jpg')}}" class="img_upload" width="160px" height="160px">
                    </div>
                    <div class="row row-cols-1 mt-3 mx-3 mb-3">
                        <form action="{{ route('upload_files') }}" method="POST" enctype="multipart/form-data" id="imageUploadForm">
                            @csrf
                            <input type="file" name="image" accept="image/*" class="form-control image_field @error('image') is-invalid @enderror">

                            @if(count($errors) > 0)
                                @foreach( $errors->all() as $message )
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endforeach
                            @endif
                            <div class="progress mt-3" id="upload-progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>

                            <div class="my-3 d-flex justify-content-end">
                                <button class="btn btn-success " type="submit">Save</button>
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
                <div class="modal-header" style="padding-left:35px;padding-right: 37px;padding-top: 35px">
                    <h5 class="modal-title" id="uploadVideoModalLabel">Upload Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-2">
                    <div class="row row-cols-1 mt-3 mx-3 mb-3">
                        <form action="{{ route('upload_video_files') }}" method="POST" enctype="multipart/form-data" id="videoUploadForm">
                            @csrf
                            <input type="file" name="video" accept="video/*" class="form-control @error('video') is-invalid @enderror" >

                            @error('video')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="progress mt-3">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>

                            <div class="my-3 d-flex justify-content-end">
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----------------------END OF VIDEO IMAGE MODAL----------------------------------->

    <!-------------------------------------------------VIDEO STREAM MODAL-------------------------------------------->
    <div class="modal fade" id="streamVideoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content m-3">
                <div class="modal-header">
                    <h5 class="modal-title file_label" id="exampleModalLabel">Playing <span class="video_title"></span></h5>
                    <button type="button" class="btn-close"   data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <video src="" width="600" height="350" controls  controlsList="nodownload"
                           oncontextmenu="return false;" id="play_video" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
    <!------------------------------------------------END OF VIDEO STREAM MODAL---------------------------------------------->

    <!----------------------GENERATE LINK MODAL------------------------------------------>
    <div class="modal fade" id="generateLinkModal" tabindex="-1" aria-labelledby="generateLinkModalLabel" aria-hidden="true"  data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header" style="padding-left:35px;padding-right: 35px;padding-top: 35px">
                    <h5 class="modal-title" id="uploadVideoModalLabel">Generate File Shared Link</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-2">
                    <div class="row row-cols-1 mt-3 mx-3 mb-3">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">
                                <span class="fw-bold">File</span>
                            </label>
                            <div>
                                <input type="text" name="file_name"  class="form-control" value="" id="file_generate_link" disabled>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">
                                <span class="fw-bold">Expiration Date</span>
                            </label>
                            <div>
                                <input type="datetime-local" name="expire_at" id="expire_at" class="form-control @error('expire_at') is-invalid @enderror" value="{{old('expire_at')}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            @error('expire_at')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="my-4 d-flex justify-content-end">
                            <button class="btn btn-success"  id="generateCodeBtn" type="submit" onclick="generateSharedLink()">Generate</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----------------------END OF GENERATE LINK MODAL----------------------------------->

    <!----------------------QR CODE LINK MODAL------------------------------------------>
    <div class="modal fade" id="qrcodeModal" tabindex="-1" aria-labelledby="grcodeModalLabel" aria-hidden="true" data-bs-backdrop="static"  data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="padding-top: 35px">
                    <h5 class="modal-title" id="uploadVideoModalLabel">Generated File Shared Link</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-2">
                    <div class="row row-cols-1 mb-3">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label d-flex justify-content-center">
                                <span class="fw-bold">Scan QR Code to access the Link</span>
                            </label>
                            <div id="qr_code" class="d-flex justify-content-center">
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-2">
                            <label for="exampleFormControlInput1" class="form-label">
                                <span class="fw-bold">Sharable Link after Scanning QR Code</span>
                            </label>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="">
                                <button class="btn btn-secondary" type="button" id="copy"
                                        onclick="copyToClipboard()">Copy Link</button>
                            </div>
                            <div>
                                <button class="btn btn-success" type="button" id="copy"
                                        onclick="copyToClipboard()">Share via Whatsapp</button>
                            </div>
                        </div>

                        <form>
                            <div class="my-3 d-flex justify-content-end">
                                <button class="btn btn-success" type="submit" onclick="saveQRCode()">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----------------------END OF QR CODE LINK MODAL----------------------------------->



    <style>
        .delete_file_btn > a{
            text-decoration: none;
            color: red;
            padding-left: 17px;
        }
        .delete_file_btn:hover {
            color: black;
        }

        .delete_file_btn:active {
            background-color: #198754;
            color: white;
        }
        .dropdown-menu > dropdown-item:active {
            background-color: #198754;
            color: white;
        }
        .dropdown-menu > li > a:active {
            background-color: #198754;
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
        var $generateLinkModal = $('#generateLinkModal');
        var $streamModal = $('#streamVideoModal');
        let link = '';
        let layout = 'grid';
        var $modal = $('#uploadImageModal');
        var $uploadVideoModal = $('#uploadVideoModal');
        var image = document.getElementById('image');
        var $qrcodeModal = $('#qrcodeModal');
        var sharedLinkResponse;
        var sharedFile;

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

        let openSharedLink = function (data){
            sharedFile = data;
            $('#file_generate_link').val(data.name)
            $generateLinkModal.modal('show')
        }

        let generateSharedLink = function (){
            let route = "{{ route('create_file_shared_link', '__fileId__') }}".replace('__fileId__', sharedFile.id);
            let expire_at = $('#expire_at').val();

            $('#generateCodeBtn').text('')
            $("#generateCodeBtn").prepend('<i class="fa fa-spinner fa-spin"></i>');
            $("#generateCodeBtn").attr("disabled", 'disabled');
            $.ajax({
                method: 'POST',
                url: route,
                data: {_token: CSRF_TOKEN, 'expire_at':expire_at},
                dataType: "json",
                success: function(response) {
                    $('#generatedLink').val(response.data)
                    generateQRCode(response.data)
                    $generateLinkModal.modal('hide')
                    $qrcodeModal.modal('show');
                    sharedLinkResponse = response;

                    $("#generateCodeBtn").find(".fa-spinner").remove();
                    $("#generateCodeBtn").removeAttr("disabled");
                },
                error:function (error){
                    $("#generateCodeBtn").find(".fa-spinner").remove();
                    $("#generateCodeBtn").removeAttr("disabled");

                    sharedLinkResponse = error;
                }
            })
        }

        let saveQRCode = function (){
            if(sharedLinkResponse){
                toastr.success("File Shared link created successfully");
            }else {
                toastr.error("Fail! Unable to generate Shared link for this file");
            }
        }

        let generateQRCode = function (url){
            var qrcode = new QRCode(document.getElementById('qr_code'),{
                width:250,
                height:250
            });
            qrcode.makeCode(url);
        }

        let closeModal = function() {
            $('#copy').html('Copy');
            $('#link').val('')
        }

        let copyToClipboard = function() {
            navigator.clipboard.writeText(($('#link').val()))
            $('#copy').html('Copied')
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

        let playVideo = function (item) {
            $('.video_title').text(item.name);
            let id = item.id;
            let route = "{{ route('get_video_path', '__ID__') }}".replace('__ID__', id);
            $streamModal.modal('show')
            $.ajax({
                method: 'GET',
                url: route,
                success: function() {

                    let path = $('#baseUrl').val()+'/files/videos/play?path='+id;
                    $('#play_video').attr("src", path)
                }
            })
        }

        $(function () {
            $(document).ready(function () {

                 $('#imageUploadForm').ajaxForm({
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
        $(function () {
            $(document).ready(function () {

                $('#videoUploadForm').ajaxForm({
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
                        $uploadVideoModal.modal('hide');
                        window.location.reload();
                    }
                });
            });
        });



     </script>
@endsection
