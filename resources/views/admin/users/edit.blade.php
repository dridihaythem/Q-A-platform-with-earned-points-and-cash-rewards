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
                <label class="col-lg-2 col-form-label">النقاط :</label>
                <div class="col-lg-10">
                    <input type="text" value="{{ $user->points }}" name="points" class="form-control">
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
                <label class="col-lg-2 col-form-label">عضو موثوق :</label>
                <div class="col-lg-10">
                    <select name="is_trusted" class="form-control">
                        <option @selected($user->is_trusted) value="1">نعم</option>
                        <option @selected(!$user->is_trusted) value="0">لا</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">النوع :</label>
                <div class="col-lg-10">
                    <select name="type" class="form-control">
                        <option @selected($user->type == 'user') value="user">مستخدم</option>
                        <option @selected($user->type == 'admin') value="admin">أدمين</option>
                        <option @selected($user->type == 'moderator') value="moderator">مشرف</option>
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
