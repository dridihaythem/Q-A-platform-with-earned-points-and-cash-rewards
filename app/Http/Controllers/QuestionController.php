<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\CreateAnswerRequest;
use App\Http\Requests\Question\CreateQuestionRequest;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Services\PointService;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function __construct(private PointService $pointService, private QuestionService $questionService)
    {
        $this->middleware('auth')->only(['create', 'store', 'answer', 'chooseBestAnswer']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::published()
            ->when(request('search'), function ($query) {
                $search = request('search');
                return $query->where('title', 'like', '%' . $search . '%')
                    ->Orwhere('content', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')->paginate(10);
        return view('questions.index', ['questions' => $questions]);
    }

    public function indexByCategory($slug)
    {
        $category =  Category::where('slug', $slug)->firstOrFail();
        $questions = Question::where('category_id', $category->id)
            ->published()->orderBy('id', 'desc')->paginate(10);
        return view('questions.index', ['questions' => $questions, 'category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('questions.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateQuestionRequest $request)
    {
        Auth::user()->questions()->create($request->all());

        return redirect()->route('questions.index')
            ->with('success', 'تم إضافة سؤالك بنجاح ، سيتم نشره بعد مراجته من قبل فريقنا');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::where('id', $id)
            ->published()
            ->with('publishedAnswers.user')
            ->firstOrFail();

        return view('questions.show', ['question' => $question, 'similar_questions' => $this->questionService->getSimilarQuestions($question)]);
    }

    public function answer(Question $question, CreateAnswerRequest $request)
    {
        Auth::user()->answers()->create([
            'question_id' => $question->id,
            'content' => $request->content
        ]);

        return redirect()->back()->with('success', 'تم إضافة إجابتك ، سيتم نشرها بعد مراجعتها من قبل فريقنا');
    }

    public function chooseBestAnswer(Question $question, Answer $answer)
    {
        abort_unless(Auth::user()->id == $question->user_id || Auth::user()->is_admin, 401);

        $question->answers()->where('best_answer', true)->update(['best_answer' => false]);
        $answer->update(['best_answer' => true]);

        $this->pointService->add($answer->user, 'BEST_ANSWER');

        return redirect()->back();
    }
}
