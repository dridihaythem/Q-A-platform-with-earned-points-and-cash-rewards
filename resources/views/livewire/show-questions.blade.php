<div>
    @foreach ($questions as $question)
    <div class="card my-2">
        <a href="{{ route('questions.show',$question) }}" class="text-decoration-none text-dark">
            <div class="card-body">
                {{ $question->title }} ؟
            </div>
        </a>
    </div>
    @endforeach


    <div class="my-2 text-center">
        <i id="questions-loading" class="fas fa-spinner fa-spin fa-3x d-none"></i>
    </div>


</div>