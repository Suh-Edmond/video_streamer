@extends('layouts.app')

@section('content')
    @include('notification')
    <div class="container">
        <div class="row justify-content-center">
            @if($hasExpired)
                <div class=" col-md-12">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{_('messages.fileLinkExpiredMsg')}} <b>{{__('messages.email')}}:
                            <span>
                        <a class="alert-link" href="mailto:{{$file->user->email}}">{{$file->user->email}}</a>
                    </span>
                        </b>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @elseif($notAvailable)
                <div class=" col-md-12">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{__('messages.fileResourceNotFoundMsg')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @else
                @if($file->file_type == \App\Constant\FileType::VIDEO)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-center fw-bold">{{ $title }}</div>

                            <div class="card-body d-flex justify-content-center m-4">
                                <video src="{{route('get_stream_video', ['fileId' => $file->id, 'notAvailable'=>$notAvailable, 'hasExpired' => $hasExpired])}}" width="600" height="350" controls  controlsList="nodownload"
                                       oncontextmenu="return false;">
                                </video>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-center fw-bold">{{ $title }}</div>

                            <div class="card-body d-flex justify-content-center m-4">
                                <img src="{{$file->getFilePath($file->id, $file->file_type)}}" alt="" style="width: 500px; height: 300px;">
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
