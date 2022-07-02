<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\QuestionsDataTable;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Question\UpdateQuestionRequest;
use App\Models\Category;
use App\Models\Question;
use App\Services\PointService;
use App\Services\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct(private PointService $pointService, private QuestionService $questionService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, QuestionsDataTable $dataTable)
    {
        return $dataTable->render('admin.questions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $categories = Category::all();
        return view('admin.questions.edit', ['question' => $question, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $question->update($request->validated());

        return redirect()->route('admin.questions.index')
            ->with('success', 'تم التعديل بنجاح');
    }

    public function publish(Question $question)
    {
        $question->update(['status' => 'published']);

        $this->pointService->add($question->user, 'CREATE_QUESTION');

        $this->questionService->createImage($question);

        return redirect()->back()
            ->with('success', 'تم النشر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Question $question)
    {
        if ($request->has('ban_user')) {
            $question->user()->update(['is_active' => false]);
        }

        $question->delete();

        return redirect()->back()
            ->with('success', 'تم الحذف بنجاح');
    }
}
