@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center header">{{ __('Scan QR Code to Access Resource') }}</div>

                    <div class="card-body d-flex justify-content-center m-4">
                        {!! QrCode::size(300)->generate('A simple example of QR code', $path); !!}
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
