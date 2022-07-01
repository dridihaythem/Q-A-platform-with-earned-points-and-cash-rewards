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
    }
}
