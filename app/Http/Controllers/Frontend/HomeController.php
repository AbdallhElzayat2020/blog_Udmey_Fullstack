<?php

namespace App\Http\Controllers\Frontend;

use App\Models\News;
use App\Models\Admin;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * HomeController class handles the frontend homepage and news details routes.
 */
class HomeController extends Controller
{
    /**
     * Displays the homepage with breaking news.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /**
         * Retrieve the 5 latest breaking news entries.
         *
         * @var \Illuminate\Support\Collection $breakingNews
         */
        $breakingNews = News::where(['is_breaking_news' => 1,])
            ->ActiveEntryis()->WithLocalize()->orderBy('id', 'DESC')->take(5)->get();
        return view('frontend.home', compact('breakingNews'));
    }

    /**
     * Displays a single news entry by its slug.
     *
     * @param string $slug The slug of the news entry.
     * @return \Illuminate\View\View
     */
    public function showNews(string $slug)
    {
        // Example: /news/some-news-slug
        // This method should retrieve the news entry by its slug and pass it to the view.
        // For now, it simply returns the news details view.
        $news = News::with(['author'])->where('slug', $slug)->ActiveEntryis()->first();
        return view('frontEnd.news-details', compact('news'));
    }
}
