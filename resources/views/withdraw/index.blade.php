@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow">
            <div class="card-header bg-primary-color">
                طلبات السحب
            </div>
            <div class="card-body">
                @include('partials.alert')
                <a href="{{ route('withdraw.create') }}" class="btn btn-primary">
                    طلب سحب رصيد
                </a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#الرقم</th>
                            <th scope="col">المبلغ</th>
                            <th scope="col">وسيلة السحب</th>
                            <th scope="col">معلومات الدفع</th>
                            <th scope="col">الحالة</th>
                            <th scope="col">ملاحظات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                        <tr>
                            <th scope="row">{{ $request->id }}</th>
                            <td>{{ $request->amount }}</td>
                            <td>{{ $request->paymentMethod->name }}</td>
                            <td>{{ $request->payment_details }}</td>
                            <td>
                                @if($request->status == 'pending')
                                <span class="badge text-bg-warning">
                                    <i class="fa fa-spinner fa-spin fa-fw"></i> تحت المراجعة
                                </span>
                                @elseif($request->status == 'approved')
                                <span class="badge text-bg-success">
                                    <i class="fa-solid fa-circle-check"></i> تم الدفع
                                </span>
                                @else
                                <span class="badge text-bg-danger">
                                    <i class="fa-solid fa-circle-xmark"></i> مرفوض
                                </span>
                                @endif
                            </td>
                            <td>
                                @if($request->note)
                                {{ $request->note }}
                                @else
                                -- لا يوجد --
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection