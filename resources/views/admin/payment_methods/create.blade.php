@extends('layouts.admin')
@include('partials.admin.datatable')

@section('content')
<div class="card mt-2">
    <div class="card-header bg-dark text-white">
        <i class="fa-solid fa-circle-plus"></i>
        إضافة وسيلة سحب
    </div>
    <div class="card-body">
        @include('partials.alert')

        <form action="{{ route('admin.payment_methods.store') }}" method="post">
            @csrf

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">العنوان :</label>
                <div class="col-lg-10">
                    <input type="text" value="{{ old('name') }}" name="name" placeholder="Paypal - بيبال"
                        class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">التعليمات :</label>
                <div class="col-lg-10">
                    <textarea type="text" name="instruction" placeholder="قم بإدخال إيميل البيبال الخاص بك"
                        class="form-control">{{ old('instruction') }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label"></label>
                <div class="col-lg-10">
                    <button class="btn btn-success">الإضافة</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection