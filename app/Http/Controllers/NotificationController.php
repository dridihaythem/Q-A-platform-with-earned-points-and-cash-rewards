<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $notifications = Auth::user()->notifications()->with('setting')->orderBy('id', 'desc')
            ->get();

        $this->maskAllAsSeen();

        return view('notifications', ['notifications' => $notifications]);
    }

    private function maskAllAsSeen()
    {
        Auth::user()->notifications()->where('seen', false)
            ->update(['seen' => true]);
    }
}
