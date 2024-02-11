@extends('layouts.app')

@section('content')
    <div class="px-5 py-3">
        <div class="flex flex-column">
            <div class="d-flex flex-column flex-md-row align-items-md-stretch py-5 px-5 bg-white">
                <div>
                    <h2 class="mb-3">@yield('title')</h2>

                    @if ($data['filter'])
                        <div class="d-flex relative gap-2">
                            @yield('filters')
                            @yield('sort')
                        </div>
                    @endif

                </div>

                <div class="ms-md-auto d-flex flex-row-reverse flex-md-column justify-content-between align-items-md-end">
                    <div class="dropdown">
                        @yield('action')
                    </div>
                    @if ($data['filter'])
                        @yield('layoutToggle')
                    @endif
                </div>
            </div>

            <div class="mt-5 px-2">
                @yield('dashboard-content')
            </div>
        </div>
    </div>

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
                        <form action="{{ route('upload_files') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="image" class="form-control image_field @error('image') is-invalid @enderror">

                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror


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

    <!----------------------UPLOAD IMAGE MODAL------------------------------------------>
    <div class="modal fade" id="uploadVideoModal" tabindex="-1" aria-labelledby="uploadVideoModalLabel" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadVideoModalLabel">Upload Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-2">
                    <div class="row row-cols-1 mt-3 mx-3 mb-3">
                        <form action="{{ route('upload_video_files') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="video" class="form-control @error('video') is-invalid @enderror" >

                            @error('video')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror


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

