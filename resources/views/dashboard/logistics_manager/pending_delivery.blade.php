@extends('layouts.main_layout')
@section('title')
Dasgboard
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        @include('notices')
        @include('dashboard.logistics_manager.logistics_manager_nav')

        <div class="card">

            <div class="card-header">
                <h4 class="card-title">PENDING DELIVERY</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order No.</th>
                                <th>Photo</th>
                                <th>Book Name</th>
                                <th>Level</th>
                                <th>Order By</th>
                                <th>Telephone</th>
                                <th>Location & Address</th>
                                <th>Assigned To</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($pendingPickupBooks as $key=>$order)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>#{{$order->id}}</td>
                                <td>


                                    <img src="/{{$order->front_photo}}" alt="Thumbnail 1" class="img-thumbnail"
                                        width="60">
                                </td>
                                <td>{{$order->book_name}}
                                    <br />
                                    <span class="badge bg-{{$order->order_status_color_code}}">
                                        {{$order->order_status_name}}
                                    </span>
                                </td>
                                <td>{{$order->level_name}}</td>
                                <td>{{$order->order_by_name}}</td>
                                <td>{{$order->delivery_telephone}}</td>
                                <td>
                                    <strong>Google Map Address</strong><br />
                                    {{$order->delivery_maps_address}}<br />

                                    <strong>User Address</strong><br />

                                    {{$order->delivery_address}}<br />
                                </td>
                                <td>{{$order->delivery_rider_name}}</td>
                                <td>


                                    <a href="/logistics/assign-delivery/{{$order->id}}"
                                        class="btn btn-sm btn-success">ASSIGN</a>

                                    <a href="/logistic-dashboard/update-delivery-status/{{$order->id}}"
                                        class="btn btn-sm btn-info">Update</a>
                                </td>

                            </tr>

                            @endforeach


                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="pagination-wrapper">
                            {{ $pendingPickupBooks->links() }}
                        </div>
                    </div>
                </div>

            </div>



        </div>
    </div>

</div>



@endsection