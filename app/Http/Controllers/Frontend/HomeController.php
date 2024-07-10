<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Tag;
use App\Models\News;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * HomeController class handles the frontend homepage and news details routes.
 */
class HomeController extends Controller
{
    /**
     * Displays the homepage with breaking news.
     * This method retrieves the 5 latest breaking news entries and passes them to the homepage view.
     */
    public function index()
    {
        /**
         * Retrieve the 5 latest breaking news entries.
         */
        $breakingNews = News::where(['is_breaking_news' => 1,])
            ->ActiveEntryis()->WithLocalize()->orderBy('id', 'DESC')->take(5)->get();
        return view('frontend.home', compact('breakingNews'));
    }

    /**
     *Displays a single news entry by its slug.

     * This method retrieves a news entry by its slug and passes it to the news details view.
     */
    public function showNews(string $slug)
    {

        /**
         * Retrieve the news entry by its slug.
         *
         * @var \App\Models\News $news
         */
        $news = News::with(['author', 'tags', 'comments'])->where('slug', $slug)
            ->ActiveEntryis()->withLocalize()
            ->first();

        /**
         * Retrieve 4 recent news entries excluding the current news entry.
         */
        $resentNews = News::with(['category', 'author'])->where('slug', '!=', $news->slug)
            ->ActiveEntryis()->withLocalize()->orderBy('id', 'DESC')->take(4)->get();

        /**
         * Retrieve the 15 most common tags.
         */
        $mostCommontTags = $this->mostCommontTags();

        // Increment the news entry's view count
        $this->countView($news);

        return view('frontEnd.news-details', compact('news', 'resentNews', 'mostCommontTags'));
    }

    /**
     * Retrieves the 15 most common tags.
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

    //
    public function handleComment(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        $comment = new Comment();
        $comment->news_id = $request->news_id;
        $comment->user_id = Auth::user()->id;
        $comment->parent_id = $request->parent_id;
        $comment->comment = $request->comment;
        $comment->save();
        return redirect()->back();
    }
}
