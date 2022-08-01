@extends('layouts.admin')
@include('partials.admin.datatable')

@push('css')
<link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
@endpush
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
<script>
    const easyMDE =  new EasyMDE({ element: document.getElementById("answer-input") ,direction:'rtl',minHeight:'100px'});
</script>
@endpush

@section('content')
<div class="card mt-2">
    <div class="card-header bg-dark text-white">
        <i class="fa-solid fa-marker"></i>
        تعديل الإجابة
    </div>
    <div class="card-body">
        @include('partials.alert')

        <form action="{{ route('admin.answers.update',$answer) }}" method="post">
            @csrf
            @method('put')

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">عنوان السؤال :</label>
                <div class="col-lg-10">
                    <input type="text" value="{{ $answer->question->title }}" class="form-control" disabled>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-lg-2 col-form-label">السؤال :</label>
                <div class="col-lg-10">
                    <textarea class="form-control" disabled>{{ $answer->question->content }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">الإجابة :</label>
                <div class="col-lg-10">
                    <textarea name="content" id="answer-input" class="form-control">{{ $answer->content }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">الحالة :</label>
                <div class="col-lg-10">
                    <select class="form-control" name="status">
                        <option @selected($answer->status == 'published') value="published">منشور</option>
                        <option @selected($answer->status == 'pending') value="pending">في إنتظار النشر</option>
                        <option @selected($answer->status == 'deleted') value="deleted">محذوف</option>
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
