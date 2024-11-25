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