@extends('layouts.admin')
@include('partials.admin.datatable')

@section('content')
<div class="card mt-2">
    <div class="card-header bg-dark text-white">
        <i class="fa-solid fa-list"></i>
        قائمة وسائل السحب
    </div>
    <div class="card-body">
        @include('partials.alert')
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover datatable">
                <thead>
                    <tr>
                        <th>العنوان</th>
                        <th>الحالة</th>
                        <th>?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($methods as $method)
                    <tr class="gradeX">
                        <td>{{ $method->name }}</td>
                        <td>
                            @if($method->is_active)
                            <span class="badge badge-primary"><i class="fa-solid fa-circle-check"></i> مفعل</span>
                            @else
                            <span class="badge badge-danger"><i class="fa-solid fa-circle-xmark"></i> مغلق</span>
                            @endif
                        </td>
                        <td>
                            <form method="post" action="{{ route('admin.payment_methods.destroy',$method) }}">
                                @csrf
                                @method('delete')
                                <a href="{{ route('admin.payment_methods.edit',$method) }}" class="btn btn-xs btn-info">
                                    <i class="far fa-edit"></i> التعديل
                                </a>
                                <button class="btn btn-xs btn-danger btn-delete">
                                    <i class="fa fa-trash"></i>
                                    الحذف
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection