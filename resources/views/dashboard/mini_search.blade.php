@extends('layouts.main_layout')
@section('title')
Welcome Home
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        @include('notices')
        @include('dashboard.user_nav')
        <div class="card">

            <div class="card-header">
                <h4 class="card-title">Search Books</h4>
            </div>
            <div class="card-body">
                @include('book._search_form')

            </div>
        </div>
    </div>
</div>


@endsection

@section('css-scripts')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

<style>
    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
        z-index: 1000;
    }

    .ui-menu-item-wrapper {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid rgba(128, 128, 128, 0.2);
    }

    .ui-menu-item-wrapper img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        margin-right: 10px;
    }

    .ui-menu-item-wrapper .info {
        display: flex;
        flex-direction: column;
    }

    .ui-menu-item-wrapper .title {
        font-weight: bold;
    }
</style>
@endsection

@section('js-scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
{{-- <script src="{{ asset('js/jquery-ui.min.js')}}"></script> --}}

<script>
    $(document).ready(function() {
        $('.select2').select2();
    
    });
</script>

@endsection