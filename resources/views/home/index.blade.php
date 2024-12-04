@extends('layouts.main_layout')
@section('title')
Welcome Home
@endsection

@section('content')

<div class="slider-area pt-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3">
                <h3>How it Works</h3><br />
                <div class="single-service-wrap-2 mb-30">
                    {{-- <div class="service-icon-2">
                        <span style="font-size: 55px;"><strong>1</strong></span>
                    </div> --}}
                    <div class="service-content-2">
                        <h3>1. Submit Book & Earn Points</h3>
                        <p>Submit your Book that you want for exchange and Earn points</p>
                    </div>
                </div>
                <hr />

                <div class="single-service-wrap-2 mb-30">
                    {{-- <div class="service-icon-2">
                        <span style="font-size: 55px;"><strong>1</strong></span>
                    </div> --}}
                    <div class="service-content-2">
                        <h3>2. Search For Book</h3>
                        <p>Search for Book you want for the Exchange</p>
                    </div>
                </div>
                <hr />

                <div class="single-service-wrap-2 mb-30">
                    {{-- <div class="service-icon-2">
                        <span style="font-size: 55px;"><strong>1</strong></span>
                    </div> --}}
                    <div class="service-content-2">
                        <h3>3. Redeem your Points</h3>
                        <p>Redeem points on the book of your choice</p>
                    </div>
                </div>
                <hr />


                <div class="single-service-wrap-2 mb-30">
                    {{-- <div class="service-icon-2">
                        <span style="font-size: 55px;"><strong>1</strong></span>
                    </div> --}}
                    <div class="service-content-2">
                        <h3>4. Collection or Delivery</h3>
                        <p>Make a Payment of KSH 50 Upon Collection or Delivery</p>
                    </div>
                </div>




            </div>


            <div class="col-xl-9 col-lg-9">
                <div
                    class="hero-slider-active-1 nav-style-1 nav-style-1-modify nav-style-1-green-2 dot-style-2 dot-style-2-position-5 dot-style-2-active-green-2 bg-gray-7">
                    <div class="single-hero-slider slider-height-4 custom-d-flex custom-align-item-center single-animation-wrap bg-img res-white-overly-xs"
                        style="background-image:url(/assets/images/slider/slider4a.jpg);">
                        <div class="row no-gutters align-items-center slider-animated-1">
                            <div class="col-12">
                                <div class="hero-slider-content-6">

                                    <h1 class="animated" style="color:white; font-size: 35px;">Exchange Books
                                        <br>Online
                                    </h1>
                                    <p class="animated" style="color:white">Exchange Books that you dont need
                                        Online. Quick & Easier</p>
                                    <div class="btn-style-1">
                                        <a class="animated btn-1-padding-4 btn-1-green-2 btn-1-font-14"
                                            href="product-details.html">Explore Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-hero-slider slider-height-4 custom-d-flex custom-align-item-center single-animation-wrap bg-img res-white-overly-xs"
                        style="background-image:url(/assets/images/slider/slider4a.jpg);">
                        <div class="row no-gutters align-items-center slider-animated-1">
                            <div class="col-12">
                                <div class="hero-slider-content-6">

                                    <h1 class="animated" style="color:white; font-size: 35px;">Exchange Books
                                        <br>Online
                                    </h1>
                                    <p class="animated" style="color:white">Exchange Books that you dont need
                                        Online. Quick & Easier</p>
                                    <div class="btn-style-1">
                                        <a class="animated btn-1-padding-4 btn-1-green-2 btn-1-font-14"
                                            href="product-details.html">Explore Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br />
            <div class="product-area pb-115">

                <div class="tab-content jump">


                    <div class="row">

                        <div class="col-md-12">
                            <hr />

                            <h4>Recent Books2</h4>
                        </div>

                        @foreach($books as $book)
                        <div class="product-plr-1 col-md-3 col-sm-6 col-12">
                            <div class="single-product-wrap mb-60">
                                <div class="product-img product-img-zoom mb-15">
                                    <a href="/book/redeem/{{$book->id}}">
                                        <img src="/{{$book->front_photo}}" alt="{{$book->book_name}}">
                                    </a>
                                </div>
                                <div class="product-content-wrap-3">
                                    <div class="product-content-categories">
                                        <a class="blue" href="/book/redeem/{{$book->id}}">{{$book->level_name}}</a>
                                    </div>
                                    <h3><a class="blue" href="/book/redeem/{{$book->id}}">{{$book->book_name}}</a></h3>
                                    <div class="product-price-4">
                                        <span>{{$book->required_points}} <span style="font-size: 12px"> points
                                                required</span></span>
                                    </div>
                                </div>
                                <div
                                    class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                    <div class="product-content-categories">
                                        <a class="blue" href="/book/redeem/{{$book->id}}">{{$book->level_name}}</a>
                                    </div>
                                    <h3><a class="blue" href="/book/redeem/{{$book->id}}">{{$book->book_name}}</a></h3>
                                    <div class="product-price-4">
                                        <span>{{$book->required_points}} <span style="font-size: 12px"> points
                                                required</span></span>
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


                    <div class="row">
                        <div class="col-md-12">
                            <div class="pagination-wrapper">
                                {{ $books->links() }}
                            </div>
                        </div>
                    </div>



                </div>
            </div>
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