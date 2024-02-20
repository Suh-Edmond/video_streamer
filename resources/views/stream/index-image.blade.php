@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center header">{{ $title }}</div>

                    <div class="card-body d-flex justify-content-center m-4">
                        <img src="{{$path}}" alt="" style="width: 500px; height: 300px;">
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

    <script>
        $(document).ready(function(){
            $(document).on('contextmenu', function(){
                return false;
            })
        })

    </script>

@endsection
