@extends('layouts.admin')
@section('content')
<div class="card mt-2">
    <div class="card-header bg-dark text-white">
        <i class="fa-solid fa-gear"></i> {{ $title }}
    </div>
    <div class="card-body">
        @include('partials.alert')

        <form method="post">
            @csrf

            @foreach ($settings as $setting)
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">{{$setting->title}} :</label>
                <div class="col-lg-10">
                    <input type="text" value="{{ $setting->value}}" name="{{ $setting->slug}}" class="form-control">
                </div>
            </div>
            @endforeach

            <div class="form-group row">
                <label class="col-lg-2 col-form-label"></label>
                <div class="col-lg-10">
                    <button class="btn btn-success">التعديل</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection