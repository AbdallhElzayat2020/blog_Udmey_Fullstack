<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Tag;
use App\Models\News;
use Illuminate\Support\Facades\DB;
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
        /**
         * Retrieve the news entry by its slug.
         *
         * @var \App\Models\News $news
         */
        $news = News::with(['author', 'tags'])->where('slug', $slug)
            ->ActiveEntryis()->withLocalize()
            ->first();

        /**
         * Retrieve 4 recent news entries excluding the current news entry.
         *
         * @var \Illuminate\Support\Collection $resentNews
         */
        $resentNews = News::with(['category', 'author'])->where('slug', '!=', $news->slug)
            ->ActiveEntryis()->withLocalize()->orderBy('id', 'DESC')->take(4)->get();

        /**
         * Retrieve the 15 most common tags.
         *
         * @var \Illuminate\Support\Collection $mostCommontTags
         */
        $mostCommontTags = $this->mostCommontTags();

        // Increment the news entry's view count
        $this->countView($news);

        return view('frontEnd.news-details', compact('news', 'resentNews', 'mostCommontTags'));
    }

    /**
     * Retrieves the 15 most common tags.
     *
     * @return \Illuminate\Support\Collection
     */
    public function mostCommontTags()
    {
        return Tag::select('name', DB::raw('COUNT(*) as count'))
            ->where('language', getLanguage())
            ->groupBy('name')
            ->orderByDesc('count')
            ->take(15)
            ->get();
    }

    /**
     * Increments the view count of a news entry.
     *
     * This method checks if the news entry has been viewed before and increments the view count accordingly.
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