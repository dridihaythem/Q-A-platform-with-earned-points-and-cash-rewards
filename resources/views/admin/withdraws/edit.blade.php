@extends('layouts.admin')
@include('partials.admin.datatable')

@section('content')
<div class="card mt-2">
    <div class="card-header bg-dark text-white">
        <i class="fa-solid fa-marker"></i>
        تعديل وسيلة السحب
    </div>
    <div class="card-body">
        @include('partials.alert')

        <form action="{{ route('admin.withdraw.update',$request) }}" method="post">
            @csrf
            @method('put')

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">ملاحظات :</label>
                <div class="col-lg-10">
                    <textarea type="text" name="note" placeholder="أكتب ملاحظات لتظهر للمستخدم في حالة رفض عملية السحب"
                        class="form-control">{{ $request->note }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label">الحالة :</label>
                <div class="col-lg-10">
                    <select name="status" class="form-control">
                        <option @selected($request->status == 'pending') value="pending">تحت الإنتظار</option>
                        <option @selected($request->status == 'approved') value="approved">مقبول</option>
                        <option @selected($request->status == 'rejected') value="rejected">ملغاة</option>
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