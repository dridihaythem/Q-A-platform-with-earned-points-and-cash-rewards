<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Category;
use App\Models\PaymentMethod;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SettingSeeder::class
        ]);

        if (App::environment('local')) {
            User::factory(10)->create();
            Category::factory(10)->create();
            Question::factory(30)->published()->create();
            Answer::factory(10)->create();
            Answer::factory(80)->published()->create();
        } else {
            Category::create([
                'slug' => 'test',
                'title' => 'التصنيف الرئيسي'
            ]);
        }

        PaymentMethod::create([
            'name' => 'paypal',
            'instruction' => 'قم بإدخال إيميل البيابل الخاص بك'
        ]);
        PaymentMethod::create([
            'name' => 'bitcoin',
            'instruction' => 'قم بأدخل رابط محفظة البيتكون الخاصة بك'
        ]);

        User::factory(1)->create([
            'email' => 'demo@admin.com',
            'password' => Hash::make('demo@admin.com'),
            'type' => 'admin',
            'is_trusted' => true
        ]);
    }
}
