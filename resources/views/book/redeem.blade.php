@extends('layouts.main_layout')
@section('title')
Welcome Home
@endsection

@section('content')

<div class="slider-area pt-30">


    <div class="container">
        <div class="row">

            <div class="col-md-12">

                <div style="border: 1px solid #d6d2d2; border-radius:8px; padding:10px">
                    <div class="row">


                        @php
                        $photoPath = public_path($book->front_photo);
                        $photoUrl = file_exists($photoPath) ? asset($book->front_photo) : asset('images/no_image.png');
                        @endphp
                        <div class="col-md-4">
                            <img src="{{$photoUrl}}" alt="" style="width:100%">
                        </div>

                        <div class="col-md-8">
                            <h3>{{$book->book_name}}</h3>
                            <p><strong>Book Level</strong>: {{$book->level_name}} </p>
                            {{-- <p><strong>Book Edition</strong>: {{$book->edition_name}} </p> --}}
                            <p><strong>Condition</strong>: Used</p>
                            <p><strong>Required Points</strong>: {{$book->required_points}}</p>

                            <h4>Redeeem Points to get this Book</h4>

                            <table class="table table-bordered">
                                <tr>
                                    <th>Required Points To redeem this book</th>
                                    <td>{{$book->required_points}}</td>
                                </tr>
                                <tr>
                                    <th>Your Points Balance</th>
                                    <td>{{App\Models\UserBookPoint::getUserPoints()}}</td>
                                </tr>
                            </table>


                            @if(App\Models\UserBookPoint::getUserPoints() >= $book->required_points)

                            <p>You have enough points to get this book <br />Please note you shall be required to pay
                                KES 50
                                prosessing fees</p>
                            @else

                            <p>You dont have enough points to get this book </p>

                            @endif

                        </div>

                    </div>
                    <br>




                    {!! Form::open([
                    'action' => 'App\Http\Controllers\BookController@redeemProcess',
                    'method' => 'POST',
                    'class' => 'form user_form',
                    'enctype' => 'multipart/form-data',
                    ]) !!}


                    <input type="hidden" name="bookID" value="{{$book->id}}">


                    <div class="row">

                        <div class="col-md-10 mt-10">

                            <h3>Delivery Location</h3>
                            <p>Please specify the delivery Location for the book</p>
                            <input type="text" name="autocomplete" id="autocomplete" class="form-control"><br />
                            <div id="mapping" style="width: 100%; height:370px">Map</div>



                            <div class="mt-10">

                                <input type="hidden" id="latitude" name="latitude">
                                <input type="hidden" id="longitude" name="longitude">
                                <input type="hidden" id="coordinates" name="coordinates">

                                {{ Form::label('address', 'Specify Full Address including Plot/Appartment Name or No,
                                floor No & House No') }}
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

                    <button type="submit" class="btn btn-success"> REDEEM POINTS</button>

                    {!! Form::close() !!}
                </div>
            </div>



        </div>
    </div>

</div>


@endsection


@section('css-scripts')
{{--
<link href="dist/css/custom.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="/css/validator/bootstrapValidator.min.css" />
<style>
    .has-error .help-block {
        color: red !important;
    }
</style>

@endsection


@section('js-scripts')
{{-- <script src="{{ asset('js/jquery-ui.min.js')}}"></script> --}}

<script src="/js/validator/bootstrapValidator.min.js"></script>


<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1p4HNRQsVDYRlXzTaXXAhJiIDU895JyE&libraries=places&callback=initMap"
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

          $('.user_form')
                .bootstrapValidator({
                    excluded: [':disabled'],
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                });
    })
</script>

@endsection