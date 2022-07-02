<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'title' => 'عدد الأسئلة المسموح بها لكل عضو خلال اليوم',
            'slug' => 'MAX_QUESTIONS_PER_DAY',
            'value' => '5'
        ]);

        Setting::create([
            'title' => 'عدد الإجابات المسموح بها لكل عضو خلال اليوم',
            'slug' => 'MAX_ANSWERS_PER_DAY',
            'value' => '5'
        ]);

        Setting::create([
            'title' => 'أقل مبلغ للسحب',
            'slug' => 'MIN_AMOUNT_TO_WITHDRAW',
            'value' => '50'
        ]);

        Setting::create([
            'title' => 'أقل عدد كلمات مسموحة لعنوان السؤال',
            'slug' => 'MIN_QUESTION_TITLE_WORDS',
            'value' => '2'
        ]);

        Setting::create([
            'title' => 'أقل عدد كلمات مسموحة لمحتوى السؤال',
            'slug' => 'MIN_QUESTION_CONTENT_WORDS',
            'value' => '10'
        ]);

        Setting::create([
            'title' => 'سعر النقطة بالدولار',
            'slug' => 'POINT_EQUAL_DOLLAR',
            'value' => '0.1'
        ]);

        Setting::create([
            'title' => 'التسجيل في الموقع',
            'slug' => 'CREATE_ACCOUNT',
            'value' => '5',
            'type' => 'points'
        ]);

        Setting::create([
            'title' => 'التسجيل من خلال رابط الإحالة',
            'slug' => 'CREATE_ACCOUNT_WITH_MY_LINK',
            'value' => '10',
            'type' => 'points'
        ]);

        Setting::create([
            'title' => 'إضافة سؤال',
            'slug' => 'CREATE_QUESTION',
            'value' => '5',
            'type' => 'points'
        ]);

        Setting::create([
            'title' => 'إضافة إجابة',
            'slug' => 'CREATE_ANSWER',
            'value' => '5',
            'type' => 'points'
        ]);

        Setting::create([
            'title' => 'الإجابة على سؤالك الخاص',
            'slug' => 'CREATE_ANSWER_ON_MY_OWN_QUESTION',
            'value' => '1',
            'type' => 'points'
        ]);

        Setting::create([
            'title' => 'إضافة إجابة أكثر من 300 حرف',
            'slug' => 'CREATE_ANSWER_MORE_300_CHARS',
            'value' => '20',
            'type' => 'points'
        ]);

        Setting::create([
            'title' => 'إختيار إجابتك كأفضل إجابة',
            'slug' => 'BEST_ANSWER',
            'value' => '10',
            'type' => 'points'
        ]);
    }
}
