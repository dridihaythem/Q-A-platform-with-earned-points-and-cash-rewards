@extends('layouts.admin')

@section('content')
<div class="card mt-2">
    <div class="card-header bg-dark text-white">
        <i class="fa-solid fa-list"></i> لوحة التحكم
    </div>
    <div class="card-body">
        @include('partials.alert')
        مرحبا بك في لوحة التحكم
    </div>
</div>
@endsection