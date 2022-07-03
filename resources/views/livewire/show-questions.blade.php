<div>
    @if($questions->count() == 0)
    <div class="alert alert-danger my-2">
        لم يتم العثور على أي نتائج
    </div>
    @else
    @switch(request()->get('filter'))
    @case('solved')
    <h4 class="text-center mt-1 mb-3">أخر الأسئلة المجابة :</h4>
    @break
    @case('unanswered')
    <h4 class="text-center mt-1 mb-3">أخر الأسئلة الغير مجابة :</h4>
    @break
    @default
    <h4 class="text-center mt-1 mb-3">أخر الأسئلة :</h4>
    @endswitch
    @endif

    @foreach ($questions as $question)
    <div
        class="card my-2 @if($question->answers_count == 0) border-danger @elseif($question->best_answer_count == 0) border-success @else bg-primary-color @endif">
        <a href="{{ route('questions.show',$question) }}" class="text-decoration-none text-dark">
            <div class="card-body">
                {{ $question->title }} ؟
            </div>
        </a>
    </div>

    @if(!$loop->first && $loop->index % 5 == 0 )
    @include('partials.ads-between-questions')
    @endif
    @endforeach


    <div class="my-2 text-center">
        <i id="questions-loading" class="fas fa-spinner fa-spin fa-3x d-none"></i>
    </div>


</div>
