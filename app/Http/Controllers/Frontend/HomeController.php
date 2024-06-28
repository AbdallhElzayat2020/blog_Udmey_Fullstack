<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $languages = Language::where('status', 1)->get();
        return view('frontend.home', compact('languages'));
    }
}
