<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Answer\UpdateAnswerRequest;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $answers = Answer::when($request->has('status'), function ($query) use ($request) {
            $query->where('status', $request->status);
        })->with('question')->get();

        return view('admin.answers.index', ['answers' => $answers]);
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

        return redirect()->back()
            ->with('success', 'تم النشر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();

        return redirect()->back()
            ->with('success', 'تم الحذف بنجاح');
    }
}
