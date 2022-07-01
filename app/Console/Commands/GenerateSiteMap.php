<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Question;
use Carbon\Carbon;
use Spatie\Sitemap\SitemapIndex;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Sitemap as SitemapTag;
use Spatie\Sitemap\Tags\Url;

class GenerateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $questions_sitemap =  Sitemap::create();
        $questions = Question::published()->OrderBy('id', 'desc')->get();
        foreach ($questions as $question) {
            $questions_sitemap->add(Url::create(route('questions.show', $question))
                ->setLastModificationDate($question->updated_at));
        }

        $questions_sitemap->writeToFile(public_path('questions.xml'));

        $categories_sitemap =  Sitemap::create();
        $categories = Category::OrderBy('id', 'desc')->get();
        foreach ($categories as $category) {
            $categories_sitemap->add(Url::create(route('category', $category))
                ->setLastModificationDate($category->updated_at));
        }
        $categories_sitemap->writeToFile(public_path('categories.xml'));


        $lastQuestionsSiteMapUpdate = null;
        if (Question::published()->count() > 0) {
            $lastQuestionsSiteMapUpdate = Question::published()->OrderBy('id', 'desc')->first()->updated_at;
        }

        $lastCategorySitemapUpdate = null;
        if (Category::count() > 0) {
            $lastCategorySitemapUpdate = Category::OrderBy('id', 'desc')->first()->updated_at;
        }

        SitemapIndex::create()
            ->add(SitemapTag::create('/questions.xml')
                ->setLastModificationDate($lastQuestionsSiteMapUpdate))
            ->add(SitemapTag::create('/categories.xml')
                ->setLastModificationDate($lastCategorySitemapUpdate))
            ->writeToFile(public_path('sitemap.xml'));
    }
}
