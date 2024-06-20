<?php

    namespace App\Http\Controllers\Admin;

    use App\Models\Category;
    use App\Models\Language;
    use App\Models\News;
    use App\Models\Tag;
    use Illuminate\Http\Request;
    use App\traits\FileUploadTrait;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Admin\AdminNewsCreateRequest;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Str;

    class NewsController extends Controller
    {
        use FileUploadTrait;

        /**
         * Display a listing of the resource.
         */
        public function index()
        {
//            $data = News::find(3);
//            dd($data->tags);
            $languages = Language::all();
            return view('admin.news.index' , compact('languages'));
        }

        /**
         * Fetch Category depending on Language
         */
        public function fetchCategory( Request $request )
        {
            $categories = Category::where('language' , $request->lang)->get();
            return $categories;
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            $languages = Language::all();
            return view('admin.news.create' , compact('languages'));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store( AdminNewsCreateRequest $request )
        {
            $imgPath = $this->handleFileUpload($request , 'image');
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

            //explode to ignore the comma and make an array
            $tags = explode(',' , $request->tags);
            $tagIds = [];

            foreach ($tags as $tag) {
                $item = new Tag();
                $item->name = $tag;
                $item->save();
                $tagIds[] = $item->id;
            }

            $news->tags()->attach($tagIds);


            toast(__('Category have been Created successfully') , 'success');
            return redirect()->route('admin.news.index');
        }

        /**
         * Display the specified resource.
         */
        public function show()
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit()
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update( Request $request )
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy()
        {
            //
        }
    }
