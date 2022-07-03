<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->editColumn('status', function (User $user) {
                if ($user->is_active) {
                    return ' <span class="badge badge-primary"><i class="fa-solid fa-circle-check"></i> نشط</span>';
                } else {
                    return '<span class="badge badge-danger"><i class="fa-solid fa-circle-xmark"></i> محظور</span>';
                }
            })
            ->editColumn('created_at', function (User $user) {
                return $user->created_at;
            })
            ->editColumn('type', function (User $user) {
                if ($user->type == 'user') {
                    return 'مستخدم';
                } else if ($user->type == 'admin') {
                    return 'أدمين';
                } else {
                    return 'مشرف';
                }
            })
            ->editColumn('is_trusted', function (User $user) {
                if ($user->is_trusted) {
                    return ' <span class="badge badge-primary"><i class="fa-solid fa-circle-check"></i> نعم</span>';
                } else {
                    return '<span class="badge badge-danger"><i class="fa-solid fa-circle-xmark"></i> لا</span>';
                }
            })
            ->addColumn('actions', function (User $user) {
                $data = "<form method='post' action='" . route('admin.users.destroy', $user) . "'>
                <input type='hidden' name='_token' value='" . csrf_token() . "'>
                <input type='hidden' name='_method' value='delete'>
                <a href='" . route('admin.users.edit', $user) . "' class='btn btn-xs btn-info'>
                    <i class='far fa-edit'></i> التعديل
                </a>
                <button class='btn btn-xs btn-danger btn-delete'>
                    <i class='fa fa-trash'></i>
                    الحذف
                </button>
            </form>";
                return $data;
            })
            ->rawColumns(['status', 'actions', 'is_trusted']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        return $model->withcount('publishedAnswers', 'publishedQuestions')
            ->when(request('filter'), function ($query) {
                $filter = request('filter');
                if ($filter == 'banned') {
                    $query->where('is_active', false);
                } else if ($filter == 'admins') {
                    $query->wherein('type', ['admin', 'moderator']);
                }
            })->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name')->title('الإسم'),
            Column::make('email')->title('البريد الإكتروني'),
            Column::make('points')->title('النقاط'),
            Column::make('status')->title('الحالة'),
            Column::make('created_at')->title('تاريخ التسجيل'),
            Column::make('published_questions_count')->title('عدد الأسئلة المنشورة'),
            Column::make('published_answers_count')->title('عدد الإجابات المنشورة'),
            Column::make('is_trusted')->title('عضو موثوق'),
            Column::make('type')->title('الصلاحيات'),
            Column::make('actions')->title('?'),
        ];
    }
}
