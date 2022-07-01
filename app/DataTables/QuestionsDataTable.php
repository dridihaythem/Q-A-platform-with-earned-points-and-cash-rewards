<?php

namespace App\DataTables;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class QuestionsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->editColumn('status', function (Question $question) {
                if ($question->status == "published") {
                    return '<span class="badge badge-primary"><i class="fa-solid fa-circle-check"></i> منشور</span>';
                } elseif ($question->status == "pending") {
                    return '<span class="badge badge-warning"><i class="fa fa-spinner fa-spin fa-fw"></i> في
              إنتظار النشر</span>';
                } else {
                    return '<span class="badge badge-danger">تم رفضه</span>';
                }
            })
            ->addColumn('actions', function (Question $question) {
                $data = '';
                if (request('status') == 'pending') {
                    $data .= "<form class='d-inline' method='post' action='" . route('admin.questions.publish', $question) . "'>
                    <input type='hidden' name='_token' value='" . csrf_token() . "'>
                    <input type='hidden' name='_method' value='put'>
                    <button class='btn btn-xs btn-success btn-delete'>
                        <i class='fa-solid fa-paper-plane'></i>
                        النشر
                    </button>
                    </form>";
                }
                $data .= "<form class='d-inline' method='post'
                action='" . route('admin.questions.destroy', $question) . "'>
                <input type='hidden' name='_token' value='" . csrf_token() . "'>
                <input type='hidden' name='_method' value='delete'>
                <a href='" . route('admin.questions.edit', $question) . "' class='btn btn-xs btn-info'>
                    <i class='far fa-edit'></i> التعديل
                </a>
                <button class='btn btn-xs btn-danger btn-delete'>
                    <i class='fa fa-trash'></i>
                    الحذف
                </button>
                </form>";
                $data .= "<form class='d-inline' method='post' 
                action='" . route('admin.questions.destroy', $question) . "'>
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

    public function query(Question $model): QueryBuilder
    {
        return $model->when(request('status'), function ($query) {
            $query->where('status', request('status'));
        })->with('category')->withCount('publishedAnswers')->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0);
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('title')->title('العنوان'),
            Column::make('category.title')->title('التصنيف'),
            Column::make('views')->title('المشاهدات'),
            Column::make('published_answers_count')->title('الإجابات'),
            Column::make('status')->title('الحالة'),
            Column::make('actions')->title('?')
        ];
    }
}
