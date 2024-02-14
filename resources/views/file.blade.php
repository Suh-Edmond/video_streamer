@extends('layouts.app')

@section("content")

    <div class="container file-player" >
        <img src="/." alt="" style="width: 500px; height: 300px;">
    </div>


    {{-- ================================== styles ========================= --}}

    <style>
        .file-player {
            height: 85vh;
            overflow-y: auto;
        }
    </style>


    {{-- ==================================== STYLES END ======================== --}}

    <script>
        $(document).ready(function(){
            $(document).on('contextmenu', function(){
                return false;
            })
        })

    </script>

@endsection

