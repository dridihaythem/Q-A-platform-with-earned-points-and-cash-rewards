@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow">
            <div class="card-header bg-primary-color">
                طلب سحب جديد
            </div>
            <div class="card-body">
                @include('partials.alert')
                @if(count($methods) == 0)
                <div class="alert alert-danger">
                    <i class="fa-solid fa-circle-xmark"></i> لا توجد أي وسيلة سحب حاليا
                </div>
                @else
                <form method="post" action="{{ route('withdraw.store') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="mb-1">وسيلة السحب :</label>
                        <select name="payment_method_id" class="form-control">
                            @foreach ($methods as $method)
                            <option @selected($method->id == old('payment_method_id')) value="{{ $method->id }}">{{
                                $method->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-1">المبلغ :</label>
                        <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" class="form-control"
                            placeholder="0.00">
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-1">معلومات الدفع :</label>
                        <textarea class="form-control" name="payment_details"
                            placeholder="">{{ old('payment_details') }}</textarea>
                    </div>
                    <button class="btn btn-primary">
                        طلب السحب
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection