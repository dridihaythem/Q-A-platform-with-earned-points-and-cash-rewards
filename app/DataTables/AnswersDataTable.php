<?php

namespace App\DataTables;

use App\Models\Answer;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class AnswersDataTable extends DataTable
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
            ->rawColumns(['status', 'actions'])
            ->editColumn('status', function (Answer $answer) {
                if ($answer->status == "published") {
                    return '<span class="badge badge-primary"><i class="fa-solid fa-circle-check"></i> منشور</span>';
                } elseif ($answer->status == "pending") {
                    return '<span class="badge badge-warning"><i class="fa fa-spinner fa-spin fa-fw"></i> في
              إنتظار النشر</span>';
                } else {
                    return '<span class="badge badge-danger">تم رفضه</span>';
                }
            })
            ->addColumn('actions', function (Answer $answer) {
                $data = '';
                if (request('status') == 'pending') {
                    $data .= "<form class='d-inline' method='post' action='" . route('admin.answers.publish', $answer) . "'>
                    <input type='hidden' name='_token' value='" . csrf_token() . "'>
                    <input type='hidden' name='_method' value='put'>
                    <button class='btn btn-xs btn-success btn-delete'>
                        <i class='fa-solid fa-paper-plane'></i>
                        النشر
                    </button>
                    </form>";
                }
                $data .= "<form class='d-inline' method='post'
                action='" . route('admin.answers.destroy', $answer) . "'>
                <input type='hidden' name='_token' value='" . csrf_token() . "'>
                <input type='hidden' name='_method' value='delete'>
                <a href='" . route('admin.answers.edit', $answer) . "' class='btn btn-xs btn-info'>
                    <i class='far fa-edit'></i> التعديل
                </a>
                <button class='btn btn-xs btn-danger btn-delete'>
                    <i class='fa fa-trash'></i>
                    الحذف
                </button>
                </form>";
                $data .= "<form class='d-inline' method='post'
                action='" . route('admin.answers.destroy', $answer) . "'>
               <input type='hidden' name='_token' value='" . csrf_token() . "'>
                <input type='hidden' name='_method' value='delete'>
                <input type='hidden' name='ban_user' value='1'>
                <button class='btn btn-xs btn-danger btn-delete'>
                    <i class='fa fa-trash'></i>
                    الحذف و الحظر
                </button>
            </form>";
                return $data;
            })
            ->rawColumns(['status', 'actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Answer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Answer $model): QueryBuilder
    {
        return $model->when(request('status'), function ($query) {
            if (Auth::user()->type == 'admin') {
                $query->where('status', request('status'));
            } else {
                $query->where('status', 'pending');
            }
        })->with('question')
            ->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('answers-table')
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
            Column::make('question.title')->title('عنوان السؤال'),
            Column::make('content')->title('الإجابة'),
            Column::make('status')->title('الحالة'),
            Column::make('actions')->title('?'),
        ];
    }
}
