@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow text-center">
            <div class="card-header bg-primary-color">
                <i class="fa-solid fa-circle-xmark"></i>
                صفحة غير موجودة
            </div>
            <div class="card-body">
                <div style="font-size: 45px">404</div>
                عفوا الصفحة غير موجودة
                <br>
                <br>
                <a class="btn btn-primary" href="{{ route('questions.index') }}">
                    <i class="fa-solid fa-house"></i>
                    العودة للصفحة الرئيسية
                </a>
            </div>
        </div>
    </div>
</div>
@endsection