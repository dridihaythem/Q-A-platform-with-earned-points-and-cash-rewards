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
    @else
    @if ($category->description)
    <div class="alert alert-info">
        <i class="fa-solid fa-bell"></i> {{$category->description}}
    </div>
    @endif
    <center>
        {{-- <img src=" {{ $category->photo }}" width="150px" height="150px"> --}}
    </center>
    @endif

    <livewire:show-questions />

</div>
@endsection
