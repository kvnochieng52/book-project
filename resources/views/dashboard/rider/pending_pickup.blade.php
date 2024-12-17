@extends('layouts.main_layout')
@section('title')
Dasgboard
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        @include('notices')
        @include('dashboard.rider.rider_nav')

        <div class="card">

            <div class="card-header">
                <h4 class="card-title">PENDING COLLECTION</h4>
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
                                <th>Posted By</th>
                                <th>Telephone</th>
                                <th>Location & Address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($pendingPickupBooks as $key=>$book)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>#{{$book->id}}</td>
                                <td><img src="/{{$book->front_image}}" alt="Thumbnail 1" class="img-thumbnail"
                                        width="60">
                                </td>
                                <td>{{$book->book_title}}
                                    <br />
                                    <span class="badge bg-{{$book->status_color_code}}">
                                        {{$book->status_name}}
                                    </span>
                                </td>
                                <td>{{$book->level_name}}</td>
                                <td>{{$book->created_by_name}}</td>
                                <td>{{$book->created_by_telephone}}</td>
                                <td>
                                    <strong>Google Map Address</strong><br />
                                    {{$book->maps_address}}<br />

                                    <strong>User Address</strong><br />

                                    {{$book->address}}<br />
                                </td>
                                <td><a href="/rider-dashboard/update-status/{{$book->id}}"
                                        class="btn btn-sm btn-info">Update</a></td>

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