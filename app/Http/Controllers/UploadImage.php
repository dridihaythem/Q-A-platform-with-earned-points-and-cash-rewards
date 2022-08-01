<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadImage extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function markdownUploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image'
        ]);

        $file = Storage::disk('uploads')->put('', $request->file('image'));

        return Storage::disk('uploads')->url($file);
    }
}
