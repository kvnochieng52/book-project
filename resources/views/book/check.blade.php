@extends('layouts.main_layout')
@section('title')
Welcome Home
@endsection

@section('content')

<div class="slider-area pt-30">


    <div class="container">
        <div class="row">


            @foreach ($books as $book)
            <div class="col-md-2">
                <div style="border: 1px solid #ccc; padding:4px; margin-bottom:10px">

                    @if (is_file($book->front_photo))

                    <img src="/{{$book->front_photo}}" style="width: 100%">
                    @else
                    <img src="/book_images/no_image.png" style="width: 100%">
                    @endif
                    <b>{{$book->book_name}}</b><br />
                    {{$book->level_name}}


                </div>

            </div>
            @endforeach







        </div>
    </div>

</div>


@endsection


@section('css-scripts')
{{--
<link href="dist/css/custom.css" rel="stylesheet"> --}}

<style>

</style>

@endsection


@section('js-scripts')
{{-- <script src="{{ asset('js/jquery-ui.min.js')}}"></script> --}}


<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1Mt2XH5_pN5ksrPXT8pWd7-grJlCtwAw&libraries=places&callback=initMap"
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
</script>

@endsection