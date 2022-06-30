@extends('layouts.app')
@section('title','تم حظر حسابك')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow text-center">
            <div class="card-header bg-primary-color">
                <i class="fa-solid fa-circle-xmark"></i>
                خطأء
            </div>
            <div class="card-body">
                <div style="font-size: 45px">حسابك محظوز</div>
                <hr>
                <div class="alert alert-danger">
                    <i class="fa-solid fa-circle-xmark"></i>
                    تم حظر حسابك لمخالتفك شروط الإستخدام
                </div>
            </div>
        </div>
    </div>
</div>
@endsection