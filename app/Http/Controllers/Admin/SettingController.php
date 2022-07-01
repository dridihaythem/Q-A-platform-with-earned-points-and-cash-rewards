<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(private SettingService $settingService)
    {
    }

    public function show($slug)
    {
        switch ($slug) {
            case 'questions-and-answers':
                $title = "إعدادات الأسئلة و الإجابات";
                $slugs = ['MIN_QUESTION_TITLE_WORDS', 'MIN_QUESTION_CONTENT_WORDS', 'MAX_QUESTIONS_PER_DAY', 'MAX_ANSWERS_PER_DAY'];
                break;
            case 'points-and-balance':
                $title = "إعدادات النقاط و الرصيد";
                $slugs = ['MIN_AMOUNT_TO_WITHDRAW', 'POINT_EQUAL_DOLLAR'];

                break;
            default:
                abort(404);
        }
        $settings = Setting::whereIn('slug', $slugs)->get();
        return view('admin.settings', ['title' => $title, 'settings' => $settings]);
    }

    public function save(Request $request, $slug)
    {
        foreach ($request->all() as $slug => $value) {
            $this->settingService->save($slug, $value);
        }
        return redirect()->back()->with('success', 'تم حفظ التعديلات بنجاح');
    }
}
