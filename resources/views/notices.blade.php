@if(count($errors)>0)
<div class="alert alert-danger alert-dismissible" style="margin-top:15px">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    @foreach($errors->all() as $error)
    {{$error}}<br>
    @endforeach
</div>
@endif


@if(session('success'))
<div class="alert alert-success alert-dismissible" style="margin-top:15px">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <b> {{session('success')}}</b>
</div>
@endif


@if(session('error'))
<div class="alert alert-danger alert-dismissible" style="margin-top:15px">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <b> {{session('error')}}</b>
</div>
@endif