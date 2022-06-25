@extends('layouts.admin')
@include('partials.admin.datatable')

@section('content')
<div class="card mt-2">
    <div class="card-header bg-dark text-white">
        <i class="fa-solid fa-list"></i>
        قائمة طلبات السحب
    </div>
    <div class="card-body">
        @include('partials.alert')
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover datatable">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>المستخدم</th>
                        <th>المبلغ</th>
                        <th>وسيلة السحب</th>
                        <th>معلومات السحب</th>
                        <th>الحالة</th>
                        <th>?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                    <tr class="gradeX">
                        <td>{{ $request->id }}</td>
                        <td>{{ $request->user->name }}</td>
                        <td>{{ $request->amount }}</td>
                        <td>{{ $request->paymentMethod->name }}</td>
                        <td>{{ $request->payment_details }}</td>
                        <td>
                            @if($request->status == 'approved')
                            <span class="badge badge-primary">
                                <i class="fa-solid fa-circle-check"></i> تم الدفع</span>
                            @elseif($request->status == 'rejected')
                            <span class="badge badge-danger">
                                <i class="fa-solid fa-circle-xmark"></i> ملغاة</span>
                            @else
                            <span class="badge badge-warning">
                                <i class="fa fa-spinner fa-spin fa-fw"></i> في الإنتظار</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.withdraw.edit',$request) }}" class="btn btn-xs btn-success">
                                <i class="far fa-edit"></i> التعديل
                            </a>
                            @if($request->status == 'pending')
                            <form class="d-inline" method="post" action="{{ route('admin.withdraw.update',$request) }}">
                                @csrf
                                @method('put')
                                <input type="hidden" name="status" value="approved">
                                <button class="btn btn-xs btn-primary btn-delete">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    القبول
                                </button>
                            </form>
                            <form class="d-inline" method="post"
                                action="{{ route('admin.withdraw.destroy',$request) }}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-xs btn-danger btn-delete">
                                    <i class="fa fa-trash"></i>
                                    الرفض
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection