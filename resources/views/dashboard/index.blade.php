@extends('layouts.main_layout')
@section('title')
Welcome Home
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        @include('notices')

        @can('is_rider')

        @include('dashboard.rider.rider_nav')
        @elsecan('is_logistics_manager')

        @include('dashboard.logistics_manager.logistics_manager_nav')


        @else
        @include('dashboard.user_nav')

        @endcan


        <div class="card">



            @can('is_rider')

            @include('dashboard.rider.rider_dashboard')
            @elsecan('is_logistics_manager')
            @include('dashboard.logistics_manager.logistics_manager_dashboard')
            @else
            @include('dashboard.user_dashboard')

            @endcan

        </div>
    </div>

</div>



@endsection