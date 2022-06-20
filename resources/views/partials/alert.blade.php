@if(Session::has('success'))
<div class="alert alert-success">
    <i class="fa-solid fa-circle-check"></i> {{ Session:get('success')}}
</div>
@elseif(Session::has('error'))
<div class="alert alert-danger">
    <i class="fa-solid fa-circle-xmark"></i> {{ Session:get('error')}}
</div>
@elseif (count($errors) > 0)
<div class="alert alert-danger">
    <i class="fa-solid fa-circle-xmark"></i> {{ $errors->first() }}
</div>
@endif