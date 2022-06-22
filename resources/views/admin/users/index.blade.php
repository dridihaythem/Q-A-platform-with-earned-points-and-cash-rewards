@extends('layouts.admin')
@include('partials.admin.datatable')

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
            <table class="table table-striped table-bordered table-hover datatable">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>الإسم</th>
                        <th>البريد الإكتروني</th>
                        <th>الرصيد</th>
                        <th>الحالة</th>
                        <th>تاريخ التسجيل</th>
                        <th>عدد الأسئلة المنشورة</th>
                        <th>عدد الإجابات المنشورة</th>
                        <th>?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="gradeX">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->balance }}</td>
                        <td>
                            @if($user->is_active)
                            <span class="badge badge-primary"><i class="fa-solid fa-circle-check"></i> نشط</span>
                            @else
                            <span class="badge badge-danger"><i class="fa-solid fa-circle-xmark"></i> محظور</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->published_questions_count }}</td>
                        <td>{{ $user->published_answers_count }}</td>
                        <td>
                            <form method="post" action="{{ route('admin.users.destroy',$user) }}">
                                @csrf
                                @method('delete')
                                <a href="{{ route('admin.users.edit',$user) }}" class="btn btn-xs btn-info">
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