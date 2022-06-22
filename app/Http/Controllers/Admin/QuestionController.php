<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Question\UpdateQuestionRequest;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $questions = Question::when($request->has('status'), function ($query) use ($request) {
            $query->where('status', $request->status);
        })->with('category')->get();
        return view('admin.questions.index', ['questions' => $questions]);
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
