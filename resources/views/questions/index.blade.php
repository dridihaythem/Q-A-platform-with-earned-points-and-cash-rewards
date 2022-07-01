@extends('layouts.app')
@if(Route::current()->getName() == 'category')
@section('title',$category->title)
@else
@section('title','الصفحة الرئيسية')
@endif
@push('css')
@livewireStyles
@endpush
@push('js')
@livewireScripts

<script type="text/javascript">
    let hasMorePosts = true;
    window.onscroll = function (ev) {
        if ((window.innerHeight + window.scrollY + 90) >= document.body.offsetHeight) {
            window.livewire.emit('load-more');
        }
    };
    document.addEventListener("DOMContentLoaded", () => {
        let loading = document.getElementById('questions-loading');
        Livewire.on('noMorePosts',() => {
            hasMorePosts = false;
            loading.classList.add('d-none');
        })
        Livewire.hook('message.sent', (el, component) => {
            if(hasMorePosts){
                loading.classList.remove('d-none');
            }
        })
        Livewire.hook('message.processed', (el, component) => {
                loading.classList.add('d-none');
        })
    });
</script>

@endpush
@section('content')
<div>
    @include('partials.alert')
    @if(Route::current()->getName() !== 'category')
    <div class="dropdown me-auto text-end">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="questions-filter" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fa-solid fa-filter"></i> الفلترة
        </button>
        <ul class="dropdown-menu" aria-labelledby="questions-filter">
            <li><a class="dropdown-item" href="{{ route('questions.index') }}?filter=solved"><i
                        class="fa-solid fa-check-double"></i> مجابة</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{ route('questions.index') }}?filter=unanswered"><i
                        class="fa-solid fa-xmark"></i> غير مجابة</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{ route('questions.index') }}"><i class="fa-solid fa-list"></i> الكل</a>
            </li>

        </ul>
    </div>
    @endif
    @if($questions->count() == 0)
    <div class="alert alert-danger my-2">
        لم يتم العثور على أي نتائج
    </div>
    @endif
    {{-- @foreach ($questions as $question)
    <div class="card my-2">
        <a href="{{ route('questions.show',$question) }}" class="text-decoration-none text-dark">
            <div class="card-body">
                {{ $question->title }} ؟
            </div>
        </a>
    </div>
    @endforeach --}}

    <livewire:show-questions />

    {{-- {{ $questions->links() }} --}}

</div>
@endsection