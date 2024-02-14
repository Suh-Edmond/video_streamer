@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center header">{{ $title }}</div>

                    <div class="card-body d-flex justify-content-center m-4">
                        <video src="{{route('get_stream_video')}}" width="600" height="350" controls  controlsList="nodownload"
                               oncontextmenu="return false;" preload="auto">

                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .header {
            font-weight: bold;
        }
    </style>
@endsection