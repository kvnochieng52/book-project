{!! Form::open([
'action' => 'App\Http\Controllers\BookController@search',
'method' => 'GET',
'class' => 'form candidate_form',
'enctype' => 'multipart/form-data',
]) !!}

<div class="row pt-10">
    <div class="col-md-12" style="background-color: #eee; padding:10px; padding-top:20px; border-radius:10px">
        <div class="row">
            <div class="col-md-4 mb-8">
                {{ Form::select('levels', App\Models\BookLevel::getBookLevels(), request()->get('levels'), ['class' =>
                'form-control select2', 'placeholder' => '--All Levels--']) }}
            </div>

            <div class="col-md-6 mb-8">
                <div class="form-group">
                    {{ Form::select('book_title', App\Models\BookInventory::query()->pluck('book_with_level', 'id'),
                    request()->get('book_title'), ['class' => 'form-control select2', 'placeholder' => '--All Books--',
                    'style' => 'width:100%']) }}
                </div>
            </div>
            <div class="col-md-2 mb-8">
                <button type="submit" class="btn btn-block btn-success">SEARCH</button>
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}