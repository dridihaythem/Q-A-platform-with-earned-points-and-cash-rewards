<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function publishedQuestions()
    {
        return $this->hasMany(Question::class)->where('status', 'published');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function publishedAnswers()
    {
        return $this->hasMany(Answer::class)->where('status', 'published');
    }
}
