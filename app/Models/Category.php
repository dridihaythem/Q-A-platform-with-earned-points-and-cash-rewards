<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function publishedQuestion()
    {
        return $this->hasMany(Question::class)->where('status', 'published');
    }
}
