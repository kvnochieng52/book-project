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
                <h4 class="card-title">Submit Book</h4>
            </div>
            {{-- <img class="card-img-top" src="img_avatar1.png" alt="Card image"> --}}
            <div class="card-body">





                {!! Form::open([
                'action' => 'App\Http\Controllers\BookController@storeBook',
                'method' => 'POST',
                'class' => 'form candidate_form',
                'enctype' => 'multipart/form-data',
                ]) !!}

                {{-- <div class="row">

                    <div class="col-md-12">
                        {{ Form::label('book_title', 'Book Title') }}
                        <div class="form-group">
                            {{ Form::text('book_title', null, ['class' => 'form-control', 'placeholder' =>
                            'Enter the Title of the book']) }}
                            <ul id="autocomplete-suggestions" class="list-group"></ul>
                        </div>
                    </div>


                    <input type="hidden" class="book_id" name="book_id">
                    <input type="hidden" class="level_id" name="level_id">
                    <input type="hidden" class="edition_id" name="edition_id">

                </div> --}}


                <div class="row">
                    <div class="col-md-12">
                        {{ Form::label('book_title', 'Book Title') }}
                        <div class="form-group">
                            {{ Form::select('book_title', $bookInventories, null, ['class' => 'form-control',
                            'placeholder'=>'--Select Book Title--', 'style'=>'width:100%', 'required'=>'required']) }}
                        </div>

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        {{ Form::label('level', 'Book Level') }}
                        <div class="form-group">
                            {{ Form::select('level', $bookLevels, null, ['class' => 'form-control',
                            'placeholder'=>'--Please select level--','style'=>'width:100%', 'required'=>'required']) }}
                        </div>

                    </div>
                </div>


                {{-- <div class="row">
                    <div class="col-md-12">
                        {{ Form::label('edition', 'Edition') }}
                        <div class="form-group">
                            {{ Form::select('edition', $bookEditions, null, ['class' => 'form-control',
                            'placeholder'=>'--Please select edition--']) }}
                        </div>

                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-md-12">
                        {{ Form::label('condition', 'Condition') }}
                        <div class="form-group">
                            {{ Form::select('condition', $bookConditions, null, ['class' => 'form-control',
                            'placeholder'=>'--Please select condition--','style'=>'width:100%', 'required'=>'required'])
                            }}
                        </div>

                    </div>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        {{ Form::label('description', 'Book Description(optional)') }}
                        <div class="form-group">
                            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' =>
                            'Enter the Description of the book', 'style'=>'height:90px']) }}
                        </div>
                    </div>

                </div>


                <div class="row" style="padding-bottom: 10px">
                    <div class="col-md-6">
                        <p><strong>Collection Location</strong> (Specify your location on where the book shall be
                            collected)</p>
                        <input type="text" name="autocomplete" id="autocomplete" class="form-control" required>

                        <div id="mapping" style="width: 100%; height:370px">Map</div>



                        <div class="mt-10">

                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">
                            <input type="hidden" id="coordinates" name="coordinates">

                            {{ Form::label('address', 'Specify Full Address including Plot/Appartment Name or No, floor
                            No & House No') }}
                            <div class="form-group">
                                {{ Form::textarea('address', null, ['class' => 'form-control', 'placeholder' =>
                                'Enter your full address', 'style'=>'height:80px','required'=>'required']) }}
                            </div>
                        </div>


                        <div class="mt-10">

                            {{ Form::label('telephone', 'Telephone') }}
                            <div class="form-group">
                                {{ Form::text('telephone', Auth::user()->telephone, ['class' => 'form-control',
                                'placeholder' =>'Enter your telephone','required'=>'required']) }}
                            </div>
                        </div>

                    </div>

                </div>




                <button type="submit" class="btn btn-success"> <strong>SUBMIT BOOK</strong></button>
            </div>



            {{-- <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="front_photo">Front Photo </label>
                        <div class="input-group">
                            <input type="file" id="front_photo" name="front_photo">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="back_photo">Back Photo </label>
                        <div class="input-group">
                            <input type="file" id="back_photo" name="back_photo">
                        </div>
                    </div>
                </div>
            </div> --}}



            {!! Form::close() !!}

        </div>
    </div>
</div>
<div class="col-md-6"></div>

</div>


@endsection

@section('css-scripts')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
@endsection

@section('js-scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
{{-- <script src="{{ asset('js/jquery-ui.min.js')}}"></script> --}}


<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBP_0fcfVMUL_4vQmkOa1dKjJJslcVUJ44&libraries=places&callback=initMap"
    async defer></script>



<script>
    <?php
                
            $latitude = '-1.3167787322285858';
            $longitude = '36.79722696171871';
            $position_pin = 'yes';
        ?>
        
        
        var input = document.getElementById('autocomplete');

        function initMap() {
            var geocoder;
            var autocomplete;

            geocoder = new google.maps.Geocoder();
            var map = new google.maps.Map(document.getElementById('mapping'), {
                center: {
                    lat: <?php echo $latitude; ?>,
                    lng: <?php echo $longitude; ?>
                },
                zoom: 11
            });
            var card = document.getElementById('locationField');
            autocomplete = new google.maps.places.Autocomplete(input);

            // Bind the map's bounds (viewport) property to the autocomplete object,
            // so that the autocomplete requests use the current map bounds for the
            // bounds option in the request.
            autocomplete.bindTo('bounds', map);

            var infowindow = new google.maps.InfoWindow();
            var infowindowContent = document.getElementById('infowindow-content');

            <?php if($position_pin=='yes') {?>
            var position_pin = new google.maps.LatLng("<?php echo $latitude; ?>", "<?php echo $longitude; ?>");
            <?php } ?>
            infowindow.setContent(infowindowContent);

            var marker = new google.maps.Marker({
                <?php if($position_pin=='yes') {?>
                position: position_pin,
                <?php } ?>
                map: map,
                anchorPoint: new google.maps.Point(0, -29),
                draggable: true
            });

            autocomplete.addListener('place_changed', function() {

                infowindow.close();
                marker.setVisible(true);
                var place = autocomplete.getPlace();
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();



                $('#latitude').val(latitude);
                $('#longitude').val(longitude);
                $('#coordinates').val(latitude + "," + longitude);
                $('#gps_coordinates').val(latitude + "," + longitude);


                if (!place.geometry) {

                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17); // Why 17? Because it looks good.
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }

                infowindowContent.children['place-icon'].src = place.icon;
                infowindowContent.children['place-name'].textContent = place.name;
                infowindowContent.children['place-address'].textContent = address;
                //infowindow.open(map, marker);
                fillInAddress();

            });

            function fillInAddress(new_address) { // optional parameter
                if (typeof new_address == 'undefined') {
                    var place = autocomplete.getPlace(input);
                } else {
                    place = new_address;
                }
                //console.log(place);
                for (var component in componentForm) {
                    document.getElementById(component).value = '';
                    document.getElementById(component).disabled = false;
                }

                for (var i = 0; i < place.address_components.length; i++) {
                    var
                        addressType = place.address_components[i].types[0];
                    if (componentForm[addressType]) {
                        var
                            val = place.address_components[i][componentForm[addressType]];
                        document.getElementById(addressType).value = val;
                    }
                }
            }
            google.maps.event.addListener(marker, 'dragend', function() {


                geocoder.geocode({
                    'latLng': marker.getPosition()
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            console.log(autocomplete);
                            $('#autocomplete').val(results[0].formatted_address);
                            $('#latitude').val(marker.getPosition().lat());
                            $('#longitude').val(marker.getPosition().lng());
                            $('#coordinates').val(marker.getPosition().lat() + "," + marker.getPosition()
                                .lng());
                            $('#gps_coordinates').val(marker.getPosition().lat() + "," + marker
                                .getPosition().lng());
                            infowindow.setContent(results[0].formatted_address);
                            infowindow.open(map, marker); //
                            // google.maps.event.trigger(autocomplete, 'place_changed');
                            // fillInAddress(results[0]);
                        }
                    }
                });
            });
        }
    $(document).ready(function() {

        $('#book_title').select2();
        $('#level').select2();
        var $input = $('#book_title');
        var $suggestions = $('#autocomplete-suggestions');

        $input.on('input', function() {
        var query = $input.val().toLowerCase();
        $suggestions.empty();

        if (query.length > 3) {
            // Send an AJAX request to the server to fetch suggestions
            $.ajax({
            url: '/book/suggest', // Replace with the actual path to your PHP script
            method: 'GET',
            data: { query: query },
            dataType: 'json',
            success: function(response) {
                // Display the matching suggestions
                response.forEach(function(suggestion) {
                //var listItem = $('<li class="list-group-item" data-bookd=>' + suggestion.book_name + '</li>');
                var listItem = $('<li class="list-group-item" data-book_id="' + suggestion.id + '"data-edition_id="' + suggestion.edition_id + '" data-level_id="' + suggestion.level_id + '">' + suggestion.book_name+ '</li>');
                $suggestions.append(listItem);
                });
            }
            });
        }
        });

        $suggestions.on('click', 'li', function() {
        var selectedSuggestion = $(this).text();

            $('.book_id').val($(this).data('book_id'));
            $('.edition_id').val($(this).data('edition_id'));
            $('.level_id').val($(this).data('level_id'));

        $input.val(selectedSuggestion);
        $suggestions.empty();
        });




  });
</script>


@endsection