<div>
    <div class="form-group mb-3">
        <label class="mb-1">السؤال :</label>
        <input wire:model="title" name="title" type="text" class="form-control"
            placeholder="ما هو سعر صرف الدولار اليوم">
    </div>
    @if(count($questions) > 0)
    <div class="my-3">
        <h4 class="fs-5 text-decoration-underlin">أسئلة شبيهة :</h4>
        <ul class="list-group">
            @foreach ($questions as $question)
            <li class="list-group-item">
                <a class="text-decoration-none text-dark" href="{{ route('questions.show',$question) }}">{{
                    $question->title
                    }}</a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>