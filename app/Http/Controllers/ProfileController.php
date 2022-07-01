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
        $user = User::where('id', Auth::user()->id)
            ->withCount(['publishedQuestions', 'publishedAnswers', 'referrals'])
            ->firstOrFail();
        return view('profile', [
            'user' => $user,
            'balance' => $this->pointService->convert(Auth::user()->points)
        ]);
    }
}
