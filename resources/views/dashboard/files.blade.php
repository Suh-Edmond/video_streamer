@extends('layouts.dashboard')

@section('title', 'My Files')
@section('action', 'Upload New Files')

@section('dashboard-content')
    @if ($data['gridView'])
        <div class="row gap-auto gap-4">
            @forelse ($data['items'] as $item)
                <div class="col-12 col-md-5 col-lg-2 mb-2 bg-white rounded">
                    <div class="d-flex flex-column align-items-center">
                        <img class="h-2 w-full pt-4" src={{ asset($item->getFilePath($item->id))}} alt="" width="150px" height="150px">
                        <div class="text-center py-4">
                            <button type="button" class="btn btn-light btn-sm w-100 dropdown-toggle"  id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> {{ $item->name }}</button>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#propertiesModal" onclick="showProperties({{$item}})">
                                        <i class="fa-solid fa-circle-info"></i>&nbsp; Properties
                                    </button></li>
                                <li><button class="dropdown-item" type="button"  >
                                        <i class="fa-solid fa-crop"></i>&nbsp; Crop
                                    </button></li>
                                <li>
                                    <button class="btn shareBtn-{{$item->id}}"   onclick="generateQRcode({{$item}})">
                                        <i
                                            class="fa-regular fa-share-from-square"></i>&nbsp; Generate QR Code
                                    </button>
                                </li>
                                <li>
                                    <button class="btn text-danger">
                                        <a href="{{route('delete_file', ['id' => $item->id])}}" onclick="event.preventDefault();
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

    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content m-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Copy the link to share this file</h5>
                    <button type="button" class="btn-close" onclick="closeModal()" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <div class="row row-gap-0 d-flex justify-content-sm-around">
                       <div class="col-8 col-sm-8 col-md-8">
                           <input class="form-control form-control-md" type="text" disabled id="link">
                       </div>
                       <div class="col-2 col-md-2 col-sm-2">
                           <button type="button" class="btn btn-primary" id="copy" onclick="copyToClipboard()">Copy</button>
                       </div>
                   </div>
                    <div class="divider my-3">OR</div>
                    <div class="d-flex justify-content-center mt-3 mb-3">
                        <button type="button" class="btn btn-success w-100" onclick="shareViaWhatsapp()" data-bs-dismiss="modal">Share via WhatsApp</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

        .divider::before, .divider::after {
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

         let generateQRcode = function (data) {
             let id = data.id;
             let route = "{{ route('share_link', '__ID__') }}".replace('__ID__', id);
             $.ajax({
                 method: 'GET',
                 url: route,
                 success: function(response){
                    $('#link').val(response.data)
                     link = response.data
                     $shareModal.modal('show');
                     console.log(link)
                 }
             })
         }
         let closeModal = function (){
             $('#copy').html('Copy');
             $('#link').val('')
         }

        let copyToClipboard = function () {
            navigator.clipboard.writeText( ($('#link').val()))
            $('#copy').html('Copied')
        }

        let shareViaWhatsapp = function () {
            window.open('https://api.whatsapp.com/send?phone=&text='+encodeURIComponent(link))
        }

        let showProperties = function (item){
            console.log(item)
            $('.item_name').text(item.name)
            $('.item_type').text(item.file_type)
            $('.item_created').text(new Date(item.created_at).toGMTString())
            $('.item_modified').text(new Date(item.updated_at).toGMTString())
            $('.item_size').text(item.size)
        }
    </script>
@endsection
