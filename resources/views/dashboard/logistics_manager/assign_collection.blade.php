@extends('layouts.main_layout')
@section('title')
Update Status
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        @include('notices')
        @include('dashboard.logistics_manager.logistics_manager_nav')

        <div class="card">

            <div class="card-header">
                <h4 class="card-title">UPDATE STATUS</h4>
            </div>
            <div class="card-body">

                {!! Form::open([
                'action' => 'App\Http\Controllers\LogisticsController@updateCollectionProcess',
                'method' => 'POST',
                'class' => 'form candidate_form',
                'enctype' => 'multipart/form-data',
                ]) !!}




                <div class="row">
                    <div class="col-md-12">
                        {{ Form::label('driver', 'Select Driver') }}
                        <div class="form-group">
                            {{ Form::select('driver', $drivers, null, ['class' => 'form-control',
                            'placeholder'=>'--Select Driver--', 'required'=>'required']) }}
                        </div>

                    </div>
                </div>


                <div class="row">

                    <div class="col-md-12">
                        {{ Form::label('description', 'Notes(optional)') }}
                        <div class="form-group">
                            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' =>
                            'Enter the Title of the book', 'style'=>'height:90px']) }}
                            <ul id="autocomplete-suggestions" class="list-group"></ul>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-success"> ASSIGN</button>
                &nbsp; &nbsp;
                <a href="/rider-dashboard/pending-pickup" class="btn btn-default btn-outline">CLOSE</a>

                <input type="hidden" name="bookID" value="{{$bookID}}">

                {!! Form::close() !!}

            </div>



        </div>
    </div>

</div>



@endsection