@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 bg-white shadow rounded-3 mb-2">
        <div class="p-5 text-center">

            <h1 class="fs-4">{{ $question->title}} ?</h1>

            <div class="mt-3">
                <span class="px-4 py-2 d-inline-block rounded-4 bg-primary-color">
                    <i class="fa-solid fa-check"></i> تمت الإجابة
                </span>
                <span class="px-4 py-2 d-inline-block rounded-4" style="background-color: #F9F9F9">
                    عدد الإجابات :3
                </span>
            </div>

        </div>
    </div>

    {{-- الإجابات --}}

    @for ($i = 0; $i < 3; $i++) <div class="col-md-10 bg-white shadow rounded-3 my-3">
        <div class="p-5">
            <div class="d-flex align-items-center gap-2">
                <img width="60px" src="https://www.ejaabat.com/avatars/0.svg" alt="">
                <div>
                    John Tol
                    <small class="mt-1 d-block text-secondary">منذ 1 سنة</small>
                </div>
            </div>
            <div class="mt-3 lh-2">
                معنى ضعف العدد في الرياضيات، هو أن يكون جمع العدد نفسه مرتين، أي ضعف العدد 2 هو 2 + 2 = 4، وضعف العدد 3
                هو 3
                + 3 = 6، أو ضرب العدد في 2، مثل 2 × 2 = 4، أو 3 × 2 = 6.
            </div>
        </div>
</div>
@endfor

{{-- أسئلة مشابهة --}}

<div class="col-md-10 bg-primary-color shadow rounded-2 my-3 py-3 text-white text-center">
    أسئلة مشابهة
</div>


</div>
@endsection