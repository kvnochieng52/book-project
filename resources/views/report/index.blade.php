@extends('layouts.main_layout')
@section('title')
Welcome Home
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">

        @include('dashboard.user_nav')




        <div class="card">
            <div class="card-body">
                <a href="/reports/book-report" class=""><i class="fas fa-file"></i> Books Submission Report</a>
            </div>

        </div>
    </div>

</div>



@endsection