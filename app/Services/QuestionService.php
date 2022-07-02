<?php

namespace App\Services;

use App\Models\Question;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
// use Johntaa\Arabic\I18N_Arabic;

class QuestionService
{
    public function getSimilarQuestions(Question $question)
    {
        return Question::where('id', '!=', $question->id)
            ->where('category_id', $question->category_id)
            ->whereHas('bestAnswer')
            ->with('bestAnswer')
            ->published()
            ->inRandomOrder()
            ->take(5)
            ->get();
    }

    public function createImage(Question $question)
    {
        //GD Library extension not available with this PHP installation.
        if (!extension_loaded('gd')) {
            return;
        }

        $width       = 1200;
        $height      = 630;
        $center_x    = $width / 2;
        $center_y    = $height / 2;
        $max_len     = 400;
        $font_size   = 45;
        $font_height = 30;

        $img = Image::make(Storage::disk('questions')->path('default.png'));
        $Arabic  = new \I18N_Arabic('Glyphs');
        $text = $Arabic->utf8Glyphs($question->title);
        $lines = explode("\n", wordwrap($text, $max_len));
        $y     = $center_y - ((count($lines) - 1) * $font_height);

        foreach ($lines as $line) {
            $img->text($line, $center_x, $y, function ($font) use ($font_size) {
                $font->file(public_path('fonts/JF Flat Regular.otf'));
                $font->size($font_size);
                $font->color('#fdf6e3');
                $font->align('center');
                $font->valign('center');
            });

            $y += $font_height * 2;
        }

        $filename = Str()->uuid() . "." . "png";

        $img->save(Storage::disk('questions')->path($filename));

        $question->update(['photo' => $filename]);
    }
}
