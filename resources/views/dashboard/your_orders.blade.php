@extends('layouts.main_layout')
@section('title')
Reports
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        @include('notices')
        @include('dashboard.user_nav')
        <div class="card">

            <div class="card-header">
                <h4 class="card-title">Your Orders</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Book ID</th>
                                <th>Photo</th>
                                <th>Book Name</th>
                                <th>Level</th>
                                <th>Edition</th>
                                <th>Status</th>
                                <th>Order Date/Time</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($orders as $key=>$order)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$order->book_id}}</td>
                                <td><img src="/{{$order->front_image}}" alt="Thumbnail 1" class="img-thumbnail"
                                        width="60">
                                </td>
                                <td>{{$order->book_title}}</td>
                                <td>{{$order->level_name}}</td>
                                <td>{{$order->edition_name}}</td>
                                <td>{{$order->order_status_name}}</td>
                                <td>{{$order->created_at}}</td>
                            </tr>

                            @endforeach


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection