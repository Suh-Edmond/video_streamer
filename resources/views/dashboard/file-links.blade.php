@extends('layouts.dashboard')

@section('title', $data['title'])


@section('sort')
    <div class="dropdown">
        <button class="btn border btn-outline-success" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="d-flex gap-1 align-items-center">
                <i class="fa-solid fa-filter"></i><span>Sort:</span>
            </div>
        </button>
        <ul class="dropdown-menu bg-white">
            <li> <a onclick="sortBy('EXPIRED')" class="dropdown-item date_filter">Expired</a></li>
            <li><a onclick="sortBy('NOT_EXPIRED')" class="dropdown-item date_filter">Not Expired</a></li>
            <li><a onclick="sortBy('ALL')" class="dropdown-item date_filter">All</a></li>
        </ul>
    </div>
@endsection

@section('action')
    <button class="btn btn-success shadow py-2 px-3 d-flex align-items-center justify-content-center gap-2" type="button" data-bs-toggle="modal"
            data-bs-target="#generateLinkModal">
        <i class="fa fa-add"></i><span>Generate Share Link</span>
    </button>
@endsection

@section('dashboard-content')
    <div>
        <table class="table table-striped">
            @if ($data['links']->total() !== 0)
                <tr>
                    <th>SN</th>
                    <th>Link</th>
                    <th>Shared Code</th>
                    <th>Expired Date</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            @endif

            @foreach($data['links'] as $item)
                <tr scope="row">
                    <td class="py-2">
                        <div class="text-muted d-flex justify-content-center align-items-center"
                        >
                            {{ $loop->index + 1 }}
                        </div>
                    </td>

                    <td class="py-2">
                        {{ $item->file_link }}
                    </td>

                    <td class="py-2">
                        {{ $item->shared_code }}
                    </td>

                    <td class="py-2">
                        {{ $item->expire_at }}
                    </td>

                    @if(\Illuminate\Support\Carbon::now()->greaterThan($item->expire_at))
                        <td class="py-2 text-danger">
                            EXPIRED
                        </td>
                    @else
                        <td class="py-2 text-success">
                            NOT EXPIRED
                        </td>
                    @endif

                    <td class="py-2">
                        <div class="dropdown">
                            <button class="btn border btn-outline-success" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item date_filter" type="button" onclick="viewQRCode({{$item}})"
                                    >
                                        <i class="fa-solid fa-qrcode"></i><span style="padding-left: 20px">View QR Code</span>
                                    </a>
                                </li>
                                <li><a class="dropdown-item date_filter" type="button" onclick="copy({{$item}})"
                                    >
                                        <i class="fa-solid fa-copy"></i><span style="padding-left: 20px">Copy</span>
                                    </a>
                                </li>
                                <li><a class="dropdown-item date_filter" type="button" data-bs-toggle="modal"
                                       data-bs-target="#editModal{{$item->id}}"
                                        >
                                        <i class="fa-solid fa-pen"></i><span style="padding-left: 20px">Edit</span>
                                    </a>
                                </li>
                                <li class="delete_file_btn">
                                    <a href="{{route('delete_file_shared_links', ['fileSharedLink' => $item])}}" >
                                        <i class="fa-solid fa-trash-can text-danger"></i><span style="padding-left: 20px">Delete</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>

                    <!----------------------EDIT LINK MODAL------------------------------------------>
                    <div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" aria-labelledby="uploadVideoModalLabel" aria-hidden="true"  data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content">
                                <div class="modal-header" style="padding-left:35px;padding-right: 35px;padding-top: 35px">
                                    <h5 class="modal-title" id="uploadVideoModalLabel">Edit File Shared Link</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-2">
                                    <div class="row row-cols-1 mt-3 mx-3 mb-3">
                                        <form action="{{ route('update_file_shared_links', ['fileSharedLink' => $item]) }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">
                                                    <span class="fw-bold">File</span>
                                                </label>
                                                <div>
                                                    <input type="text" name="file_name"  class="form-control" value="{{$data['file']->name}}" disabled>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">
                                                    <span class="fw-bold">Shared Link</span>
                                                </label>
                                                <div>
                                                    <input type="text" name="shared_link"  class="form-control" value="{{$item->file_link}}" disabled >
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">
                                                    <span class="fw-bold">Expiration Date</span>
                                                </label>
                                                <div>
                                                    <input type="datetime-local" name="expire_at"  class="form-control @error('video') is-invalid @enderror" value="{{$item->expire_at}}" >
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
                                                <button class="btn btn-success  editBtn" onclick="updateLink()" type="submit" >Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----------------------END OF EDIT LINK MODAL----------------------------------->


                @endforeach
        </table>
        @if($data['links']->total() == 0)
            <p>No shared links available for this file</p>
        @endif

        @if(count($data['links']->items()) > 0)
            <div class="d-flex justify-content-sm-end">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li   class="{{$data['links']->currentPage() == 1 ? 'page-item disabled':'page-item'}}">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @for($i = 1; $i <= $data['links']->lastPage(); $i++)
                            <li class="{{$data['links']->currentPage() == $i ? 'page-item active':'page-item'}}">
                                <a class="page-link" href="{{route('file_shared_links', ['fileId' => $data['file']->id, 'page' => $i])}}">{{$i}}</a>
                            </li>
                        @endfor
                        <li class="{{$data['links']->currentPage() == $data['links']->lastPage() ? 'page-item disabled': 'page-item'}}">
                            <a class="page-link" href="{{route('file_shared_links', ['fileId' => $data['file']->id, 'page' => $data['links']->currentPage() + 1])}}">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif

    </div>

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
                                <input type="text" name="file_name"  class="form-control" value="{{$data['file']->name}}" disabled>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">
                                <span class="fw-bold">Expiration Date</span>
                            </label>
                            <div>
                                <input type="datetime-local" name="expire_at" id="expire_at" class="form-control @error('expire_at') is-invalid @enderror" value="{{old('expire_at')}}" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            @error('expire_at')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="my-3 d-flex justify-content-end">
                            <button class="btn btn-success"  id="generateCodeBtn" type="submit" onclick="generateSharedLink({{$data['file']}})">Generate</button>
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
                <div class="modal-header" style="padding-top: 35px;padding-right: 35px;padding-left: 35px">
                    <h5 class="modal-title" id="uploadVideoModalLabel">Generated File Shared Link</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeQRCodeModal()"></button>
                </div>
                <div class="modal-body p-2">
                    <div class="row row-cols-1 mb-3">
                        <div class="mb-3" style="padding-left: 35px">
                            <label for="exampleFormControlInput1" class="form-label d-flex justify-content-start">
                                <span class="fw-bold">Scan QR Code to access the Link</span>
                            </label>
                            <div id="qr_code" class="d-flex justify-content-center">
                            </div>
                        </div>
                        <div class="divider" style="padding-right: 35px;padding-left: 35px">OR</div>
                        <div class="d-flex justify-content-between mt-4" style="padding-left: 35px;padding-right: 35px">
                            <button class="btn btn-secondary" type="button" id="copy"
                                    onclick="copyToClipboard()">Copy Link</button>
                            <button class="btn btn-success" type="button" id="copy"
                                    onclick="copyToClipboard()">Share Link via Whatsapp</button>
                        </div>

                        <form class="mt-2">
                            <div class="my-4 d-flex justify-content-end" style="padding-right: 30px">
                                <button class="btn btn-success" type="submit" onclick="saveQRCode()">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----------------------END OF QR CODE LINK MODAL----------------------------------->


    <!----------------------VIEW QR CODE LINK MODAL------------------------------------------>
    <div class="modal fade" id="viewQRCodeModal" tabindex="-1" aria-labelledby="viewQRCodeModalLabel" aria-hidden="true" data-bs-backdrop="static"  data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadVideoModalLabel">QR Code for <span>{{$data['file']->name}}</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeViewModal()"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="row row-cols-1 mb-4 mx-3">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label d-flex justify-content-center">
                            </label>
                            <div id="view_qr_code" class="d-flex justify-content-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----------------------END OF VIEW QR CODE LINK MODAL----------------------------------->




    <style>
        .divider {
            font-size: 15px;
            display: flex;
            font-weight: bold;
            align-items: center;
        }

        .divider::before, .divider::after {
            flex: 1;
            content: '';
            padding: 1px;
            background-color: black;
            margin: 5px;
        }
        .delete_file_btn > a{
            text-decoration: none;
            color: red;
            padding-left: 17px;
        }
        .delete_file_btn:hover {
            color: black;
        }
        .date_filter {
            cursor: pointer;
        }

        .delete_file_btn:active{
            background-color: #198754;
            color: white;
        }
        .link {
            font-weight: bold;
        }

        .dropdown-menu > dropdown-item:active {
            background-color: #198754;
            color: white;
        }
        .dropdown-menu > li > a:active {
            background-color: #198754;
            color: white;
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
        var $qrcodeModal = $('#qrcodeModal');
        var sharedLinkResponse;
        var $viewQRCodeModal = $('#viewQRCodeModal');

        let applyParams = function(sort) {
            let url = new URL(location.href);
            let searchParams = new URLSearchParams(url.search);
            searchParams.set('sort', sort);
            url.search = searchParams.toString();

            location.href = url
        }

        let sortBy = function(newSort) {
            applyParams(newSort);
        }

        let viewQRCode = function (item) {
            $('#fileName').text(item.name);
            $('#view_qr_code').css({'pointer-events': 'none'})
            generateQRCode(item.file_link, 'view_qr_code')
            $viewQRCodeModal.modal('show');

        }

        let closeViewModal = function (){
            $('#view_qr_code').html("")
        }

        let updateLink = function (){
            $('.editBtn').text('')
            $(".editBtn").prepend('<i class="fa fa-spinner fa-spin"></i>');
        }

        let generateSharedLink = function (file){
            let route = "{{ route('create_file_shared_link', '__fileId__') }}".replace('__fileId__', file.id);
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
                    $('#link').val(response.data)
                    generateQRCode(response.data, "qr_code")
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
            $qrcodeModal.modal('hide');
            if(sharedLinkResponse){
                toastr.success("File Shared link created successfully");
                return;
            }
            toastr.error("Fail! Unable to generate Shared link for this file");
        }

        let closeQRCodeModal = function (){
            $qrcodeModal.modal('hide');
            if(sharedLinkResponse){
                toastr.success("File Shared link created successfully");
                return;
            }
            toastr.error("Fail! Unable to generate Shared link for this file");
        }

        let copyToClipboard = function() {
            navigator.clipboard.writeText(($('#link').val()))
            $('#copy').html('Copied')
        }

        let generateQRCode = function (url, docEle){
            var qrcode = new QRCode(document.getElementById(docEle),{
                width:250,
                height:250
            });
            qrcode.makeCode(url);

            $('#view_qr_code').css({'pointer-events': 'none'})

            $('#qr_code').css({'pointer-events':'none'});
        }

        let copy = function (item){
            navigator.clipboard.writeText(item.file_link)
        }
    </script>
@endsection
