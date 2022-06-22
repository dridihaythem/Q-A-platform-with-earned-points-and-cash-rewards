@extends('layouts.admin')
@include('partials.admin.datatable')

@section('content')
<div class="card mt-2">
    <div class="card-header bg-dark text-white">
        <i class="fa-solid fa-marker"></i>
        تعديل وسيلة السحب
    </div>
    <div class="card-body">
        @include('partials.alert')

        <form action="{{ route('admin.payment_methods.update',$method) }}" method="post">
            @csrf
            @method('put')
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">العنوان :</label>
                <div class="col-lg-10">
                    <input type="text" value="{{ $method->name }}" name="name" placeholder="Paypal - بيبال"
                        class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">التعليمات :</label>
                <div class="col-lg-10">
                    <textarea type="text" name="instruction" placeholder="قم بإدخال إيميل البيبال الخاص بك"
                        class="form-control">{{ $method->instruction }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">الحالة :</label>
                <div class="col-lg-10">
                    <select name="method" class="form-control">
                        <option @selected($method->is_active) value="1">نشيط</option>
                        <option @selected(!$method->is_active) value="0">مغلق</option>
                    </select>
                </div>
            </div>

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