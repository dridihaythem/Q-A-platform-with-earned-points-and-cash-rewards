<?php

namespace App\Services;

use App\Models\Question;

class QuestionService
{
    public function getSimilarQuestions(Question $question)
    {
        return Question::where('id', '!=', $question->id)
            ->where('category_id', $question->category_id)
            ->whereHas('bestAnswer')
            ->with('bestAnswer')
            ->published()
            ->inRandomOrder()
            ->take(5)
            ->get();
    }
}
