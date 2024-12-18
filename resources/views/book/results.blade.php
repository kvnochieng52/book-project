@extends('layouts.main_layout')
@section('title')
Search Results
@endsection

@section('content')

<div class="slider-area pt-30">
    <div class="container">
        <div>
            <button id="toggle-search-form" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Show or Hide
                Search Form</button>
            <div id="search-form" style="display: none;">
                @include('book._search_form')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-10">
                <h3>Search Results</h3>
                <p>{{ count($books) }} Found</p>
                <hr />
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach($books as $book)
            @php
            $photoPath = public_path($book->front_image);
            $photoUrl = file_exists($photoPath) ? asset($book->front_image) : asset('images/no_image.png');
            @endphp
            <div class="product-plr-1 col-md-3 col-sm-6 col-12">
                <div class="single-product-wrap mb-60">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="/book/redeem/{{$book->id}}">
                            <img src="{{$photoUrl}}" alt="{{$book->book_title}}">
                        </a>
                    </div>
                    <div class="product-content-wrap-3">
                        <div class="product-content-categories">
                            <a class="blue" href="/book/redeem/{{$book->id}}">{{$book->level_name}}</a>
                        </div>
                        <h3><a class="blue" href="/book/redeem/{{$book->id}}">{{$book->book_title}}</a></h3>
                        <div class="product-price-4">
                            <span>{{$book->required_points}} <span style="font-size: 12px"> points
                                    required</span></span>
                        </div>
                    </div>
                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                        <div class="product-content-categories">
                            <a class="blue" href="/book/redeem/{{$book->id}}">{{$book->level_name}}</a>
                        </div>
                        <h3><a class="blue" href="/book/redeem/{{$book->id}}">{{$book->book_title}}</a></h3>
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
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="pagination-wrapper">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

@section('css-scripts')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

<style>
    .product-img img {
        width: 100%;
        height: auto;
        max-height: 280px;
        object-fit: cover;
    }

    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
        z-index: 1000;
    }

    .ui-menu-item-wrapper {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid rgba(128, 128, 128, 0.2);
    }

    .ui-menu-item-wrapper img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        margin-right: 10px;
    }

    .ui-menu-item-wrapper .info {
        display: flex;
        flex-direction: column;
    }

    .ui-menu-item-wrapper .title {
        font-weight: bold;
    }
</style>
@endsection

@section('js-scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {

      
        $('.select2').select2();

       
    });
</script>

@endsection