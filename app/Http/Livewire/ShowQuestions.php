<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Livewire\Component;

class ShowQuestions extends Component
{
    public $limitPerPage = 10;

    protected $listeners = [
        'load-more' => 'loadMore',
    ];


    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 10;
    }

    public function render()
    {
        $questions = Question::published()
            ->when(request('search'), function ($query) {
                $search = request('search');
                return $query->where('title', 'like', '%' . $search . '%')
                    ->Orwhere('content', 'like', '%' . $search . '%');
            })
            ->when(request('filter'), function ($query) {
                $filter = request('filter');
                if ($filter == 'unanswered') {
                    return $query->doesntHave('publishedAnswers');
                } else if ($filter == 'solved') {
                    return $query->whereHas('publishedAnswers');
                }
            })
            ->orderBy('id', 'desc')
            ->paginate($this->limitPerPage);

        return view('livewire.show-questions', ['questions' => $questions]);
    }
}
