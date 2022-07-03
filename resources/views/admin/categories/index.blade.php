@extends('layouts.admin')
@include('partials.admin.datatable')

@section('content')
<div class="card mt-2">
    <div class="card-header bg-dark text-white">
        <i class="fa-solid fa-list"></i>
        قائمة التنصيفات
    </div>
    <div class="card-body">
        @include('partials.alert')
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover datatable">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>العنوان</th>
                        <th>التصنيف الرئيسي</th>
                        <th>عدد الأسئلة</th>
                        <th>?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr class="gradeX">
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->category?->title }}</td>
                        <td>{{ $category->published_question_count }}</td>
                        <td>
                            <form method="post" action="{{ route('admin.categories.destroy',$category) }}">
                                @csrf
                                @method('delete')
                                <a href="{{ route('admin.categories.edit',$category) }}" class="btn btn-xs btn-info">
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
