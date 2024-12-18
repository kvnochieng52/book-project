<!-- resources/views/partials/book_search_form.blade.php -->
<div style="padding: 8px; border:1px solid #eee; background-color:#f8f8f8; margin-top:10px; border-radius:8px">
    {!! Form::open([
    'action' => 'App\Http\Controllers\BookController@search',
    'method' => 'GET',
    'class' => 'form',
    'enctype' => 'multipart/form-data',
    ]) !!}

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="book-search">
                    <h5><strong>Search Book By Title or Level</strong></h5>
                </label>
                <input type="text" id="book-search" class="form-control" placeholder="Search for a book" name="title"
                    value="{{ request()->get('title') }}" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mb-3">
            {{ Form::select('levels', App\Models\BookLevel::getBookLevels(), request()->get('levels'), ['class' =>
            'form-control select2', 'placeholder' => '--All Levels--', 'style'=>'width:100%;']) }}
        </div>

        <div class="col-md-4">
            <button type="submit" class="btn btn-block btn-info"><i class="fas fa-search"></i> SEARCH</button>
        </div>
    </div>

    {!! Form::close() !!}
</div>

@section('js-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();

        $('#toggle-search-form').click(function() {
          $('#search-form').toggle();
        });
        $("#book-search").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "/autocomplete",
                    dataType: "json",
                    data: {
                        q: request.term
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.title,
                                value: item.id,
                                thumbnail: item.thumbnail,
                                title: item.title,
                                subtitle: item.subtitle
                            };
                        }));
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                window.location.href = "/book/search?title=" + ui.item.title + "&id=" + ui.item.value + "&level=" + ui.item.subtitle;
            }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
            return $("<li>")
                .append("<div class='ui-menu-item-wrapper'><img src='" + item.thumbnail + "'><div class='info'><span class='title'>" + item.title + "</span><span class='subtitle'>" + item.subtitle + "</span></div></div>")
                .appendTo(ul);
        };
    });
</script>
@endsection