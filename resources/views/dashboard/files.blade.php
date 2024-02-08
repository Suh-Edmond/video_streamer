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
                            <button class="btn shareBtn-{{$item->id}}" title="Generate QR Code" onclick="generateQRcode({{$item}})">
                                <i
                                    class="fa-regular fa-share-from-square"></i>
                            </button>
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

    <style>

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
    </script>
@endsection
