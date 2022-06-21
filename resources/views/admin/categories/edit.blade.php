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

        <form action="{{ route('admin.categories.update',$category) }}" method="post">
            @csrf
            @method('put')
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
                <label class="col-lg-2 col-form-label"></label>
                <div class="col-lg-10">
                    <button class="btn btn-success">التعديل</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection