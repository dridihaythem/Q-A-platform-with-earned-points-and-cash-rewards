@extends('layouts.app')
@section('title','تسجيل حساب جديد')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary-color">
                <i class="fa-solid fa-user-plus"></i> تسجيل حساب جديد
            </div>
            <div class="card-body">
                @include('partials.alert')

                <a class="btn btn-primary d-block mb-2 w-75 mx-auto" href="{{ route('auth.redirect','facebook') }}">
                    <i class="fa-brands fa-facebook-f"></i> الدخول عن طريق الفيسبوك
                </a>

                <a class="btn btn-primary d-block mb-2 w-75 mx-auto" style="background-color:#2AA9E0!important"
                    href="{{ route('auth.redirect','twitter') }}">
                    <i class="fa-brands fa-twitter"></i> الدخول عن طريق تويتر
                </a>

                <a class="btn btn-danger d-block mb-2 w-75 mx-auto" href="{{ route('auth.redirect','google') }}">
                    <i class="fa-brands fa-google"></i> الدخول عن طريق جوجل
                </a>

                <form method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="mb-1">الإسم كاملا :</label>
                        <input name="name" type="name" class="form-control" placeholder="قم بإدخال إسمك كاملا">
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-1">البريد الإكتروني :</label>
                        <input name="email" type="email" class="form-control"
                            placeholder="قم بإدخال البريد الإكتروني الخاص بك">
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-1">كلمة المرور :</label>
                        <input name="password" type="password" class="form-control" placeholder="********">
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-1">تأكيد كلمة المرور :</label>
                        <input name="password_confirmation" type="password" class="form-control" placeholder="********">
                    </div>
                    <button class="btn btn-success">
                        التسجيل
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection