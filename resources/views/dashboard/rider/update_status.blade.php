@extends('layouts.main_layout')
@section('title')
Update Status
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        @include('notices')
        @include('dashboard.rider.rider_nav')

        <div class="card">

            <div class="card-header">
                <h4 class="card-title">UPDATE STATUS</h4>
            </div>
            <div class="card-body">

                {!! Form::open([
                'action' => 'App\Http\Controllers\RiderDashboardController@updateStatusProcess',
                'method' => 'POST',
                'class' => 'form candidate_form',
                'enctype' => 'multipart/form-data',
                ]) !!}




                <div class="row">
                    <div class="col-md-12">
                        {{ Form::label('status', 'Status') }}
                        <div class="form-group">
                            {{ Form::select('status', $statuses, null, ['class' => 'form-control',
                            'placeholder'=>'--Select the order Status--']) }}
                        </div>

                    </div>
                </div>


                <div class="row">

                    <div class="col-md-12">
                        {{ Form::label('description', 'Description(optional)') }}
                        <div class="form-group">
                            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' =>
                            'Enter the Title of the book', 'style'=>'height:90px']) }}
                            <ul id="autocomplete-suggestions" class="list-group"></ul>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-success"> UPDATE STATUS</button>
                &nbsp; &nbsp;
                <a href="/rider-dashboard/pending-pickup" class="btn btn-default btn-outline">CLOSE</a>

                <input type="hidden" name="bookID" value="{{$bookID}}">

                {!! Form::close() !!}

            </div>



        </div>
    </div>

</div>



@endsection