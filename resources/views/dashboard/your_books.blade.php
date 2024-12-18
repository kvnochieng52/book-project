@extends('layouts.main_layout')
@section('title')
Your Books
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        @include('notices')
        @include('dashboard.user_nav')
        <div class="card">

            <div class="card-header">
                <h4 class="card-title">Your Books</h4>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Book ID</th>
                                <th>Photo</th>
                                <th>Book Name</th>
                                <th>Level</th>
                                <th>Book Points</th>
                                <th>Swap Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($books as $key=>$book)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$book->id}}</td>
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
                                <td>{{$book->book_points}}</td>
                                <td>
                                    <span class="badge bg-{{$book->swap_status_color_code}}">
                                        {{$book->swap_status_name}}
                                    </span>
                                </td>
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