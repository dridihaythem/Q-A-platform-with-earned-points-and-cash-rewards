<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Services\PointService;
use App\DataTables\AnswersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Answer\UpdateAnswerRequest;

class AnswerController extends Controller
{

    public function __construct(private PointService $pointService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AnswersDataTable $dataTable)
    {
        return $dataTable->render('admin.answers.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        return view('admin.answers.edit', ['answer' => $answer->load('question')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
        $answer->update($request->validated());

        return redirect()->route('admin.answers.index')
            ->with('success', 'تم التعديل بنجاح');
    }

    public function publish(Answer $answer)
    {
        $answer->update(['status' => 'published']);

        $this->pointService->handleAnswerPoints($answer);

        return redirect()->back()
            ->with('success', 'تم النشر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Answer $answer)
    {
        if ($request->has('ban_user')) {
            $answer->user()->update(['is_active' => false]);
        }

        $answer->delete();

        return redirect()->back()
            ->with('success', 'تم الحذف بنجاح');
    }
}
