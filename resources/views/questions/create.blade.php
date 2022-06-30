@extends('layouts.app')
@section('title','إضافة سؤال')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary-color">
                <i class="fa-solid fa-circle-plus"></i> إضافة سؤال
            </div>
            <div class="card-body">
                @include('partials.alert')
                @can('create-question')
                <form method="post" action="{{ route('questions.store') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="mb-1">التصنيف :</label>
                        <select class="form-control" name="category_id">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"> {{ $category->title }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-1">السؤال :</label>
                        <input name="title" type="text" class="form-control" placeholder="ما هو سعر صرف الدولار اليوم">
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-1">وصف السؤال :</label>
                        <textarea name="content" class="form-control">{{ old('content') }}</textarea>
                    </div>
                    <button class="btn btn-primary">
                        الإضافة
                    </button>
                </form>
                @else
                <div class="alert alert-danger">
                    عفوا ، لا يمكنك نشر أكثر من 5 أسئلة كل يوم
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection