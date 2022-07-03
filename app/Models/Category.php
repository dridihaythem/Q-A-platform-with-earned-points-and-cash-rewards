<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getPhotoAttribute($value)
    {
        if ($value == null) {
            return null;
        }
        return Storage::disk('categories')->url($value);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class);
    }

    public function publishedQuestion()
    {
        return $this->hasMany(Question::class)->where('status', 'published');
    }
}
