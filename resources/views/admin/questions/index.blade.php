@extends('layouts.admin')
@include('partials.admin.datatable-api')
@section('content')
<div class="card mt-2">
    <div class="card-header bg-dark text-white">
        <i class="fa-solid fa-list"></i>
        قائمة الأسئلة
        @if(request()->status == 'pending') في إنتظار النشر @else المنشورة @endif
    </div>
    <div class="card-body">
        @include('partials.alert')
        <div class="table-responsive">
            {{$dataTable->table()}}
        </div>
    </div>
</div>
@endsection