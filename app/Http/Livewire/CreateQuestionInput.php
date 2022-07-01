<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Livewire\Component;

class CreateQuestionInput extends Component
{
    public $title;

    public $questions = [];

    public $words = [];

    public function updatedTitle($value)
    {
        $this->words = explode(' ', $value);
        $this->questions = Question::published()
            ->where(function ($query) {
                foreach ($this->words as $word) {
                    $query->orWhere('title', 'LIKE', '%' . $word . '%');
                    $query->orWhere('content', 'LIKE', '%' . $word . '%');
                }
            })
            ->take(6)
            ->get();
    }

    public function render()
    {
        return view('livewire.create-question-input');
    }
}
