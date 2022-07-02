@extends('layouts.app')
@section('title','الإشعارات')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">

        @foreach($notifications as $notification)
        <div class="card shadow-sm mb-3">
            <div class="card-body position-relative">

                <p style="background-color: #F2F2F2!important;" class=" text-black p-3 mt-2 rounded">
                    @if(!$notification->seen)
                    <span class="badge text-bg-danger px-3 py-2">
                        <i class="fa-regular fa-bell"></i>
                        إشعار جديد
                    </span>
                    @endif

                    مبروك ، لقد
                    <strong>
                        @switch($notification->setting->slug)
                        @case('BEST_ANSWER')
                        تم {{ $notification->setting->title}}
                        @break

                        @case('CREATE_ACCOUNT_WITH_MY_LINK')
                        تم {{ $notification->setting->title}} الخاص بك
                        @break

                        @default
                        قمت ب {{ $notification->setting->title}}
                        @endswitch
                    </strong>
                    و تحصلت على
                    <strong> {{$notification->points}} نقاط</strong>

                </p>
                <small class="d-block text-end text-secondary">{{ $notification->created_at->diffForHumans() }}</small>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection