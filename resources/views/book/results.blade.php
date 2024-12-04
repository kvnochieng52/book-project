@extends('layouts.main_layout')
@section('title')
Welcome Home
@endsection

@section('content')

<div class="slider-area pt-30">




    <div class="container">

        @include('book._search_form')
        <div class="row">
            <div class="col-md-12 mt-10">
                <h3>Search Results</h3>
                <p>{{count($books)}} Found</p>
                <hr />
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach($books as $book)

            <div class="product-plr-1 col-md-3">
                <div class="single-product-wrap mb-60">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="/book/redeem/{{$book->id}}">
                            <img src="/{{$book->front_photo}}" alt="">
                        </a>

                    </div>
                    <div class="product-content-wrap-3">
                        <div class="product-content-categories">
                            <a class="blue" href="/book/redeem/{{$book->id}}">{{$book->level_name}}</a>
                        </div>
                        <h3><a class="blue" href="/book/redeem/{{$book->id}}">{{$book->book_name}} </a>
                        </h3>

                        <div class="product-price-4">
                            <span>{{$book->required_points}} <span style="font-size: 12px"> points
                                    required</span></span>
                        </div>
                    </div>
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                        <div class="product-content-categories">
                            <a class="blue" href="/book/redeem/{{$book->id}}">{{$book->level_name}}</a>
                        </div>
                        <h3><a class="blue" href="/book/redeem/{{$book->id}}">{{$book->book_name}}</a>
                        </h3>

                        <div class="product-price-4">
                            <span>{{$book->required_points}} <span style="font-size: 12px"> points
                                    required</span> </span>
                        </div>
                        <div class="pro-add-to-cart-2">

                            <a href="/book/redeem/{{$book->id}}">
                                <button title="Add to Cart">Get Book</button>
                            </a>
                        </div>
                    </div>
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
    .product-img img {
        width: 100%;
        height: auto;
        max-height: 280px;
        /* Adjust the max-height as needed */
        object-fit: cover;
    }
</style>

@endsection


@section('js-scripts')
{{-- <script src="{{ asset('js/jquery-ui.min.js')}}"></script> --}}

<script>
    $(document).ready(function() {
    });

</script>

@endsection