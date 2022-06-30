@extends('layouts.app')
@section('content')
<style>
    .badge-title {
        right: 0;
        border-top-left-radius: 0px !important;
    }
</style>
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow text-center">
            <div class="card-body position-relative">
                <span class="badge rounded-pill text-bg-dark px-3 fs-6 d-block position-absolute badge-title">معلومات
                    الحساب
                </span>
                <div class="mt-3">
                    <img class="rounded-circle shadow" width="170" height="170" src="{{ Auth::user()->avatar }}" alt="">
                </div>

                <div class="my-3 kufi fs-5">{{ Auth::user()->name }}</div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-sm rounded-3 px-4">
                        <i class="nav-icon fa-solid fa-arrow-right-from-bracket"></i>
                        تسجيل الخروج
                    </button>
                </form>
            </div>
        </div>


        <div class="card shadow text-center my-4">
            <div class="card-body position-relative">
                <span class="badge rounded-pill text-bg-dark px-3 fs-6 d-block position-absolute badge-title">الرصيد و
                    الأرباح
                </span>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="text-success fw-bold fs-4">{{ $user->points }}</div>
                        <div class="kufi mt-2">عدد النقاط</div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-success fw-bold fs-4">{{ $balance }} <span>$</span></div>
                        <div class="kufi mt-2">الرصيد</div>
                    </div>
                    <div class="col-md-12">
                        <a href="{{ route('withdraw.index') }}" class="btn btn-primary btn-sm my-2 px-4">
                            <i class="fa-brands fa-paypal"></i>
                            طلب سحب الأرباح
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow text-center my-4">
            <div class="card-body position-relative">
                <span class="badge rounded-pill text-bg-dark px-3 fs-6 d-block position-absolute badge-title">الإحصائيات
                </span>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="text-success fw-bold fs-4">{{ $user->published_questions_count }}</div>
                        <div class="kufi mt-2">أسئلتي</div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-success fw-bold fs-4">{{ $user->published_answers_count }}</div>
                        <div class="kufi mt-2">إجاباتي</div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-success fw-bold fs-4">--</div>
                        <div class="kufi mt-2">عدد الإحالات</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow my-4">
            <div class="card-body position-relative">
                <span class="badge rounded-pill text-bg-dark px-3 fs-6 d-block position-absolute badge-title">
                    دعوة الإصدقاء
                </span>
                <div class="row justify-content-center mt-5">
                    <div class="col-md-10">
                        <label class="mb-1" for="">رابط الإحالة :</label>
                        <input type="text" class="form-control" disabled
                            value="{{ route('register')}}?id={{Auth::user()->id}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection