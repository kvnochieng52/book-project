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
                {!! Form::open([
                'action' => 'App\Http\Controllers\ReportController@collectionReportProcess',
                'method' => 'GET',
                'class' => 'form candidate_form',
                'enctype' => 'multipart/form-data',
                ]) !!}

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('from_date', 'From Date') !!}
                            {!! Form::date('from_date', \Carbon\Carbon::now(), ['class' => 'form-control',
                            'required'=>true]) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('to_date', 'To Date') !!}
                            {!! Form::date('to_date', \Carbon\Carbon::now(), ['class' =>
                            'form-control','required'=>true]) !!}
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">SUBMIT</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

</div>



@endsection