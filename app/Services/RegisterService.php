<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cookie;

class RegisterService
{
    public function __construct(private PointService $pointService)
    {
    }

    public function updateRef(User $user)
    {
        if (Cookie::has('id')) {
            $ref = User::where('id', Cookie::get('id'))->first();
            if ($ref) {
                $user->update(['user_id' => $ref->id]);
            }
        }
    }
}
