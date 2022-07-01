@extends('layouts.app')
@if(Route::current()->getName() == 'category')
@section('title',$category->title)
@else
@section('title','الصفحة الرئيسية')
@endif
@section('content')
<div>
    @include('partials.alert')
    <div class="dropdown me-auto">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="questions-filter" data-bs-toggle="dropdown"
            aria-expanded="false">
            الفلترة
        </button>
        <ul class="dropdown-menu" aria-labelledby="questions-filter">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
    </div>
    @if($questions->count() == 0)
    <div class="alert alert-danger my-2">
        لم يتم العثور على أي نتائج
    </div>
    @endif
    @foreach ($questions as $question)
    <div class="card my-2">
        <a href="{{ route('questions.show',$question) }}" class="text-decoration-none text-dark">
            <div class="card-body">
                {{ $question->title }} ؟
            </div>
        </a>
    </div>
    @endforeach

    {{ $questions->links() }}

</div>
@endsection