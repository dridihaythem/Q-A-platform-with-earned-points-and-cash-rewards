@extends('layouts.admin')
@include('partials.admin.datatable')

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
            <table class="table table-striped table-bordered table-hover datatable">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>العنوان</th>
                        <th>التنصيف</th>
                        <th>المشاهدات</th>
                        <th>الإجابات</th>
                        <th>الحالة</th>
                        <th>?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                    <tr class="gradeX">
                        <td>{{ $question->id }}</td>
                        <td>{{ $question->title }}</td>
                        <td>{{ $question->category->title }}</td>
                        <td>{{ $question->views }}</td>
                        <td>--</td>
                        <td>
                            @if($question->status == "published")
                            <span class="badge badge-primary"><i class="fa-solid fa-circle-check"></i> منشور</span>
                            @elseif($question->status == "pending")
                            <span class="badge badge-warning"><i class="fa fa-spinner fa-spin fa-fw"></i> في
                                إنتظار النشر</span>
                            @else
                            <span class="badge badge-danger">تم رفضه</span>
                            @endif
                        </td>
                        <td>
                            @if(request()->status == 'pending')
                            <form method="post" action="{{ route('admin.questions.publish',$question) }}"
                                class="d-inline">
                                @csrf
                                @method('put')
                                <button class="btn btn-xs btn-success btn-delete">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    النشر
                                </button>
                            </form>
                            @endif
                            <form class="d-inline" method="post"
                                action="{{ route('admin.questions.destroy',$question) }}">
                                @csrf
                                @method('delete')
                                <a href="{{ route('admin.questions.edit',$question) }}" class="btn btn-xs btn-info">
                                    <i class="far fa-edit"></i> التعديل
                                </a>
                                <button class="btn btn-xs btn-danger btn-delete">
                                    <i class="fa fa-trash"></i>
                                    الحذف
                                </button>
                            </form>
                            <form class="d-inline" method="post"
                                action="{{ route('admin.questions.destroy',$question) }}">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="ban_user" value="1">
                                <button class="btn btn-xs btn-danger btn-delete">
                                    <i class="fa fa-trash"></i>
                                    الحذف و الحظر
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