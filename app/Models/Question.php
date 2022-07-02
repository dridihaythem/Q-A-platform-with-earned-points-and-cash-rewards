<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getPhotoAttribute($value)
    {
        if ($value == null) {
            return null;
        }
        return Storage::disk('questions')->url($value);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function publishedAnswers()
    {
        return $this->hasMany(Answer::class)->where('status', 'published');
    }

    public function bestAnswer()
    {
        return $this->hasOne(Answer::class)
            ->where('status', 'published')
            ->where('best_answer', true);
    }
}
