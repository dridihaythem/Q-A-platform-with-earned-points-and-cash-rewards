@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary-color">
                <i class="fa-solid fa-right-to-bracket"></i> الدخول إلى حسابك
            </div>
            <div class="card-body">
                @include('partials.alert')
                <form method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="mb-1">البريد الإكتروني :</label>
                        <input name="email" type="email" class="form-control"
                            placeholder="قم بإدخال البريد الإكتروني الخاص بك">
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-1">كلمة المرور :</label>
                        <input name="password" type="password" class="form-control" placeholder="********">
                    </div>
                    <button class="btn btn-primary">
                        الدخول
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection