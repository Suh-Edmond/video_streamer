@extends('layouts.app')

@section('content')
    <div class="px-5 py-3">
        <div class="flex flex-column">
            <div class="d-flex flex-column flex-md-row align-items-md-stretch py-5 px-5 bg-white">
                <div>
                    <h2 class="mb-3">@yield('title')</h2>

                    @if ($data['filter'])
                        <div class="d-flex relative gap-2">
                            <div class="dropdown">
                                <button class="btn border btn-outline-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    All files
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">All files</a></li>
                                    <li><a class="dropdown-item" href="#">Images only</a></li>
                                    <li><a class="dropdown-item" href="#">Videos only</a></li>
                                </ul>
                            </div>

                            <div class="dropdown">
                                <button class="btn border btn-outline-secondary" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="d-flex gap-1 align-items-center">
                                        <i class="fa-solid fa-filter"></i><span>Sort:</span>
                                    </div>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Newest First</a></li>
                                    <li><a class="dropdown-item" href="#">Oldest First</a></li>
                                    <li><a class="dropdown-item" href="#">Name</a></li>
                                </ul>
                            </div>
                        </div>
                    @endif

                </div>

                <div class="ms-md-auto d-flex flex-row-reverse flex-md-column justify-content-between align-items-md-end">
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-add"></i> @yield('action')
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#uploadImageModal">Upload Images</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#uploadVideoModal">Upload Videos</a></li>
                        </ul>
                    </div>
                    @if ($data['filter'])
                        <div>
                            <span>View: </span>
                            <div class="btn-group" role="group" aria-label="view">
                                <button type="button" class="btn border"><i
                                        class="fas fa-th-large"></i></button>
                                <button type="button" class="btn border"><i class="fa fa-list"></i></button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-5 px-2">
                @yield('dashboard-content')
            </div>
        </div>
    </div>

    <!----------------------UPLOAD IMAGE MODAL------------------------------------------>
    <div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadImageModalLabel">Upload Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-2">
                    <div class="row row-gap-2 m-5">
                        <img id="image" src="{{asset('assets/images/bg_image.png')}}" class="img_upload" width="150px" height="150px">
                    </div>
                    <div class="row row-cols-1 mt-3 mx-3 mb-3">
                        <form action="{{ route('upload_files') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="image" class="form-control image_field">

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


    <!--------------------------------SCRIPT SECTION------------------------------------>
    <script>
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
                    console.log(reader)
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });



    </script>
    <!--------------------------------END OF SCRIPT SECTION----------------------------->
@endsection

