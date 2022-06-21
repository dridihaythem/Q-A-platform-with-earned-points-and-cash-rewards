@extends('layouts.admin')
@include('partials.admin.datatable')

@section('content')
<div class="card mt-2">
    <div class="card-header bg-dark text-white">
        <i class="fa-solid fa-marker"></i>
        تعديل السؤال
    </div>
    <div class="card-body">
        @include('partials.alert')

        <form action="{{ route('admin.questions.update',$question) }}" method="post">
            @csrf
            @method('put')
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">التصنيف :</label>
                <div class="col-lg-10">
                    <select class="form-control" name="category_id">
                        @foreach ($categories as $category)
                        <option @selected($question->category_id == $category->id) value="{{ $category->id }}"> {{
                            $category->title }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">العنوان :</label>
                <div class="col-lg-10">
                    <input type="text" value="{{ $question->title }}" name="title" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">المحتوى :</label>
                <div class="col-lg-10">
                    <textarea name="content" class="form-control">{{ $question->content }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">الحالة :</label>
                <div class="col-lg-10">
                    <select class="form-control" name="status">
                        <option @selected($question->status == 'published') value="published">منشور</option>
                        <option @selected($question->status == 'pending') value="pending">في إنتظار النشر</option>
                        <option @selected($question->status == 'deleted') value="deleted">محذوف</option>
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