<?php

namespace App\Http\Controllers\Frontend;

use App\Models\News;
use App\Models\Admin;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $languages = Language::where('status', 1)->get();

        $breakingNews = News::where([
            'status' => 1,
            'is_approved' => 1,
            'is_breaking_news' => 1,
            'language' => getLanguage(),
        ])->get();


        return view('frontend.home', compact('languages', 'breakingNews'));
    }
}
