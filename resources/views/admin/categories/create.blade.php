@extends('layouts.admin')
@include('partials.admin.datatable')

@section('content')
<div class="card mt-2">
    <div class="card-header bg-dark text-white">
        <i class="fa-solid fa-circle-plus"></i>
        إضافة تصنيف جديد
    </div>
    <div class="card-body">
        @include('partials.alert')

        <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">التصنيف الرئيسي :</label>
                <div class="col-lg-10">
                    <select name="category_id" class="form-control">
                        <option value="">-- لا يوجد --</option>
                        @foreach ($categories as $category)
                        <option @selected(old('category_id')==$category->id) value="{{$category->id}}">{{
                            $category->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">ال Slug :</label>
                <div class="col-lg-10">
                    <input type="text" value="{{ old('slug') }}" name="slug" placeholder="أسئلة-عامة"
                        class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">العنوان :</label>
                <div class="col-lg-10">
                    <input type="text" value="{{ old('title') }}" name="title" placeholder="أسئلة عامة"
                        class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">الوصف :</label>
                <div class="col-lg-10">
                    <input type="text" value="{{ old('description') }}" name="description" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">صورة :</label>
                <div class="col-lg-10">
                    <input type="file" name="file" class="form-control">
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
