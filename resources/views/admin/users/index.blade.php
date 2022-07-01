@extends('layouts.admin')
@include('partials.admin.datatable')
@include('partials.admin.datatable-api')
@section('content')
<div class="card mt-2">
    <div class="card-header bg-dark text-white">
        <i class="fa-solid fa-list"></i>
        قائمة الأعضاء
        @if(request()->filter == "banned")
        المحظورين
        @elseif(request()->filter == "admins")
        المديرين
        @endif
    </div>
    <div class="card-body">
        @include('partials.alert')
        <div class="table-responsive">
            {{$dataTable->table()}}
        </div>
    </div>
</div>
@endsection