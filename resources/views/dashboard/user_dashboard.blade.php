<div class="card-header">
    <h4 class="card-title">Dashboard, Welcome {{ Auth::user()->name }}</h4>
</div>
<div class="card-body">

    <p class="card-text">Your Total Points.</p>

    <h3 class="card-title">{{$userPoints->points}}</h3>
    <a href="/dashboard/mini-search" class="btn btn-primary">Reedem</a>
</div>