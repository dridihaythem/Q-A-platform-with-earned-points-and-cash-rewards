@extends('layouts.app')
@section('title',$question->title)
@push('meta')
<meta property="og:image" content="{{ $question->photo}}">
@endpush
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 bg-white shadow rounded-3 mb-2">
        <div class="pt-2 text-end">
            <span style="font-size: 12px" class="text-secondary">المشاركة :</span>
            <a the target="_blank" href="https://www.facebook.com/sharer.php?u={{ route('questions.show',$question)}}"
                class="btn btn-primary btn-sm rounded-2"><i class="fa-brands fa-facebook-square"></i></a>
            <a the target="_blank" href="https://api.whatsapp.com/send?text={{ route('questions.show',$question)}}"
                class="btn btn-success btn-sm rounded-2"><i class="fa-brands fa-whatsapp"></i></a>
        </div>
        <div class="p-4 text-center">
            <h1 class="fs-4">{{ $question->title}} ؟</h1>
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
                <img width="60px" class="rounded-circle" src="{{ Auth::user()->avatar }}" alt="">
                <div>
                    {{ Auth::user()->name }}
                </div>
            </div>
            <div class="mt-3 lh-2">
                @can('create-answer')
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
                @else
                <div class="alert alert-danger">
                    عفوا ، لا يمكنك إضافة أكثر من 5 إجابات كل يوم
                </div>
                @endcan
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
    <div class="col-md-10 shadow rounded-3 my-3 @if($answer->best_answer) bg-primary-color @else bg-white @endif">
        <div class="p-5">
            <div class="d-flex align-items-center gap-2">
                <img width="60px" class="rounded-circle" src="{{ $answer->user->avatar }}" alt="">
                <div>
                    {{ $answer->user->name }}
                    <small class="mt-1 d-block text-secondary">{{ $answer->created_at->diffForHumans() }}</small>
                </div>
            </div>
            <div class="mt-3 lh-2">
                {{ $answer->content }}
                @if(!$answer->best_answer && (Auth::check() && (Auth::user()->id == $question->user_id ||
                Auth::user()->is_admin)))
                <form class="my-1" method="post"
                    action="{{ route('questions.choose_best_answer',['question'=>$question,'answer'=>$answer]) }}">
                    @csrf
                    <button class="btn btn-success btn-sm float-end"><i class="fa-solid fa-check"></i> الإختيار كأفضل
                        إجابة</button>
                    <div class="clearfix"></div>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach

    {{-- أسئلة مشابهة --}}

    @if($similar_questions->count() > 0)
    <div class="col-md-10 bg-primary-color shadow rounded-2 my-3 py-3 text-white text-center">
        أسئلة مشابهة
    </div>

    @foreach ($similar_questions as $similar_question)
    <div class="col-md-10 shadow rounded-2 my-3 py-3 ">
        <span class="bg-primary-color rounded-circle d-inline-block me-2 p-2 text-center">?</span>
        <a class="text-dark text-decoration-none" href="{{ route('questions.show',$similar_question)}}">
            {{ $similar_question->title }} ؟
            <p class="text-secondary mt-2 ms-3"> {{ Str()->limit( $similar_question->bestAnswer->content,155) }} </p>
        </a>
    </div>
    @endforeach
    @endif


</div>
@endsection