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
     * This method retrieves the 5 latest breaking news entries and passes them to the homepage view.
     *
     * @return \Illuminate\View\View
     * @example <http://example.com/> (Homepage with breaking news)
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
     * This method retrieves a news entry by its slug and passes it to the news details view.
     *
     * @param string $slug The slug of the news entry.
     * @return \Illuminate\View\View
     * @example <http://example.com/news/some-news-slug> (News details page)
     */
    public function showNews(string $slug)
    {
        // Retrieve the news entry by its slug
        $news = News::with(['author', 'tags'])->where('slug', $slug)
            ->ActiveEntryis()->withLocalize()
            ->first();

        $resentNews = News::with(['category','author'])->where('slug', '!=', $news->slug)
            ->ActiveEntryis()->withLocalize()->orderBy('id', 'DESC')->take(4)->get();

        // Increment the news entry's view count
        $this->countView($news);

        return view('frontEnd.news-details', compact('news', 'resentNews'));
    }

    /**
     * Increments the view count of a news entry.
     *
     * @param \App\Models\News $news The news entry to increment the view count for.
     * @return void
     */
    public function countView($news)
    {
        if ($news) {
            if (session()->has('viewed_post')) {

                $postIds = session('viewed_post');

                if (!in_array($news->id, $postIds)) {

                    $postIds[] = $news->id;

                    $news->increment('views');
                }
                session(['viewed_post' => $postIds]);
            } else {

                session(['viewed_post' => [$news->id]]);
                $news->increment('views');
            }
        }
    }
}
