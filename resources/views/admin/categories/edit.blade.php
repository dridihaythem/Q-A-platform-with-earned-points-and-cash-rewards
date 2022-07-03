@extends('layouts.admin')
@include('partials.admin.datatable')

@section('content')
<div class="card mt-2">
    <div class="card-header bg-dark text-white">
        <i class="fa-solid fa-marker"></i>
        تعديل التصنيف
    </div>
    <div class="card-body">
        @include('partials.alert')

        <form action="{{ route('admin.categories.update',$category) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">التصنيف الرئيسي :</label>
                <div class="col-lg-10">
                    <select name="category_id" class="form-control">
                        <option value="">-- لا يوجد --</option>
                        @foreach ($categories as $_category)
                        <option @selected($_category->id==$category->id) value="{{$_category->id}}">{{
                            $_category->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">ال Slug :</label>
                <div class="col-lg-10">
                    <input type="text" value="{{ $category->slug }}" name="slug" placeholder="أسئلة-عامة"
                        class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">العنوان :</label>
                <div class="col-lg-10">
                    <input type="text" value="{{ $category->title }}" name="title" placeholder="أسئلة عامة"
                        class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">الوصف :</label>
                <div class="col-lg-10">
                    <input type="text" value="{{ $category->description }}" name="description" class="form-control">
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
                    <button class="btn btn-success">التعديل</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
