@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 bg-white shadow rounded-3 mb-2">
        <div class="p-5 text-center">

            <h1 class="fs-4">{{ $question->title}} ?</h1>
            <p>{{ $question->content }}</p>
            <div class="mt-3">
                <span
                    class="px-4 py-2 d-inline-block rounded-4 @if(count($question->publishedAnswers) == 0) bg-danger text-white @else bg-primary-color @endif">
                    @if(count($question->publishedAnswers) == 0)
                    <i class="fa-solid fa-circle-xmark"></i> لم تتم الإجابة بعد
                    @else
                    <i class="fa-solid fa-check"></i> تمت الإجابة
                    @endif
                </span>
                <span class="px-4 py-2 d-inline-block rounded-4" style="background-color: #F9F9F9">
                    عدد الإجابات : {{count($question->publishedAnswers)}}
                </span>
            </div>

        </div>
    </div>

    {{-- إضافة إجابة --}}

    @auth
    <div class="col-md-10 bg-white shadow rounded-3 my-3">
        <div class="p-5">
            <div class="d-flex align-items-center gap-2">
                <img width="60px" src="https://www.ejaabat.com/avatars/0.svg" alt="">
                <div>
                    {{ Auth::user()->name }}
                </div>
            </div>
            <div class="mt-3 lh-2">
                @include('partials.alert')
                <form method="post" action="{{ route('questions.answer',$question) }}">
                    @csrf
                    <div class="mb-3">
                        <label>الإجابة :</label>
                        <textarea name="content" class="form-control">{{ old('content') }}</textarea>
                    </div>
                    <button class="btn btn-sm btn-primary"><i class="fa-solid fa-paper-plane"></i> إضافة
                        الإجابة</button>
                </form>
            </div>
        </div>
    </div>
    @else
    <div class="col-md-10 bg-white shadow rounded-3 my-3">
        <div class="p-5">
            <div class="mt-3 lh-2">
                <div class="alert alert-info">
                    <i class="fa-solid fa-circle-info"></i> قم بتسجيل الدخول لإضافة إجابة
                </div>
            </div>
        </div>
    </div>
    @endauth

    {{-- الإجابات --}}

    @foreach($question->publishedAnswers as $answer)
    <div class="col-md-10 bg-white shadow rounded-3 my-3">
        <div class="p-5">
            <div class="d-flex align-items-center gap-2">
                <img width="60px" src="https://www.ejaabat.com/avatars/0.svg" alt="">
                <div>
                    {{ $answer->user->name }}
                    <small class="mt-1 d-block text-secondary">{{ $answer->created_at->diffForHumans() }}</small>
                </div>
            </div>
            <div class="mt-3 lh-2">
                {{ $answer->content }}
            </div>
        </div>
    </div>
    @endforeach

    {{-- أسئلة مشابهة --}}

    <div class="col-md-10 bg-primary-color shadow rounded-2 my-3 py-3 text-white text-center">
        أسئلة مشابهة
    </div>


</div>
@endsection