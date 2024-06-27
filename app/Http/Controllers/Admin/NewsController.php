<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\News;
use App\Models\Category;
use App\Models\Language;

// use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\traits\FileUploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\AdminNewsCreateRequest;
use App\Http\Requests\Admin\AdminNewsUpdateRequest;

class NewsController extends Controller
{
    use FileUploadTrait;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $languages = Language::all();

        return view('admin.news.index', compact('languages'));
    }

    /**
     * Fetch Category depending on Language
     */
    public function fetchCategory(Request $request)
    {
        $categories = Category::where('language', $request->lang)->get();

        return $categories;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all();

        return view('admin.news.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminNewsCreateRequest $request)
    {
        // التعامل مع رفع الملف
        $imgPath = $this->handleFileUpload($request, 'image');

        $news = new News();
        $news->language = $request->language;
        $news->category_id = $request->category;
        $news->author_id = Auth::guard('admin')->user()->id;
        $news->image = $imgPath;
        $news->title = $request->title;
        $news->slug = Str::slug($request->input('title'));
        $news->content = $request->input('content');
        $news->meta_title = $request->meta_title;
        $news->meta_description = $request->meta_description;
        $news->is_breaking_news = $request->is_breaking_news == 1 ? 1 : 0;
        $news->show_at_slider = $request->show_at_slider == 1 ? 1 : 0;
        $news->show_at_popular = $request->show_at_popular == 1 ? 1 : 0;
        $news->status = $request->status == 1 ? 1 : 0;
        $news->save();

        // التعامل مع الوسوم
        $tags = explode(',', $request->tags);
        $tagIds = [];

        // foreach ($tags as $tag) {
        //     $item = Tag::firstOrCreate(['name' => $tag]);
        //     $tagIds[] = $item->id;
        // }
                
        foreach ($tags as $tag) {
            $item = new Tag();
            $item->name = $tag;
            $item->save();
            $tagIds[] = $item->id;
        }

        $news->tags()->attach($tagIds);

        toast(__('Category have been Created successfully'), 'success');

        return redirect()->route('admin.news.index');
    }

    /**
     * Change toggle status of news
     */
    public function toggleNewsStatus(Request $request)
    {
        try {
            $news = News::findOrFail($request->id);
            $news->{$request->name} = $request->status;
            $news->save();

            return response([
                'status' => 'success',
                'message' => 'Updated successfully !',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $languages = Language::all();

        $news = News::findOrFail($id);

        $categories = Category::where('language', $news->language)->get();

        return view('admin.news.edit', compact('languages', 'news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminNewsUpdateRequest $request, string $id)
    {
        $news = News::findOrFail($id);

        // handle file upload
        $imgPath = $this->handleFileUpload($request, 'image');

        $news->language = $request->language;
        $news->category_id = $request->category;
        $news->image = !empty($imgPath) ? $imgPath : $news->image;
        $news->title = $request->title;
        $news->slug = Str::slug($request->title);
        $news->content = $request->content;
        $news->meta_title = $request->meta_title;
        $news->meta_description = $request->meta_description;
        $news->is_breaking_news = $request->is_breaking_news == 1 ? 1 : 0;
        $news->show_at_slider = $request->show_at_slider == 1 ? 1 : 0;
        $news->show_at_popular = $request->show_at_popular == 1 ? 1 : 0;
        $news->status = $request->status == 1 ? 1 : 0;
        $news->save();

        //explode to ignore the comma and make an array
        $tags = explode(',', $request->tags);
        $tagIds = [];

        //            Delete Previous Tags
        $news->tags()->delete();
        //            detach Tages pivot Table
        $news->tags()->detach($news->tags);
        foreach ($tags as $tag) {
            $item = new Tag();
            $item->name = $tag;
            $item->save();
            $tagIds[] = $item->id;
        }

        $news->tags()->attach($tagIds);

        toast(__('Udated successfully'), 'success');

        return redirect()->route('admin.news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);
        $this->deleteFile($news->image);
        $news->tags()->delete();
        $news->delete();
        return response(['status' => 'success', 'message' => 'Deleted successfully']);
    }

    /**
     * Copy News 
     */
    // public function copyNews(string $id)
    // {
    //     $news = News::findOrFail($id);
    //     $copyNews = $news->replicate();
    //     // $copyNews->image = $news->image; // Ensure the image path is copied
    //     $copyNews->save();

    //     toast(__('Copied successfully'), 'success');
    //     return redirect()->back();
    // }
    public function copyNews($id)
    {
        // جلب البيانات الأصلية
        $news = News::findOrFail($id);

        // عمل نسخة جديدة من الكائن
        $newNews = $news->replicate();
        
        // نسخ الصورة إلى مسار جديد باستخدام دالة duplicateFile من الـ Trait
        if ($news->image) {
            $newImagePath = $this->duplicateFile($news->image);
            $newNews->image = $newImagePath;
        }

        // حفظ النسخة الجديدة في قاعدة البيانات
        $newNews->save();
        
        // نسخ العلاقات المرتبطة (مثل الوسوم)
        $newNews->tags()->attach($news->tags);

        toast(__('News have been Cloned successfully'), 'success');

        return redirect()->route('admin.news.index');
    }   
}
