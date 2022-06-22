@extends('layouts.admin')
@include('partials.admin.datatable')

@section('content')
<div class="card mt-2">
    <div class="card-header bg-dark text-white">
        <i class="fa-solid fa-marker"></i>
        تعديل العضو
    </div>
    <div class="card-body">
        @include('partials.alert')

        <form action="{{ route('admin.users.update',$user) }}" method="post">
            @csrf
            @method('put')
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">الإسم :</label>
                <div class="col-lg-10">
                    <input type="text" value="{{ $user->name }}" name="name" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">البريد الإكتروني :</label>
                <div class="col-lg-10">
                    <input type="text" value="{{ $user->email }}" name="email" disabled class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">الرصيد :</label>
                <div class="col-lg-10">
                    <input type="text" value="{{ $user->balance }}" name="balance" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">الحالة :</label>
                <div class="col-lg-10">
                    <select name="is_active" class="form-control">
                        <option @selected($user->is_active) value="1">نشيط</option>
                        <option @selected(!$user->is_active) value="0">محظور</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">النوع :</label>
                <div class="col-lg-10">
                    <select name="is_admin" class="form-control">
                        <option @selected(!$user->is_admin) value="0">مستخدم</option>
                        <option @selected($user->is_admin) value="1">أدمين</option>
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