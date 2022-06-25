<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PointService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(private PointService $pointService)
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::withCount(['publishedQuestions', 'publishedAnswers'])->firstOrFail(Auth::user()->id);
        return view('profile', [
            'user' => $user,
            'balance' => $this->pointService->convert(Auth::user()->points)
        ]);
    }
}
