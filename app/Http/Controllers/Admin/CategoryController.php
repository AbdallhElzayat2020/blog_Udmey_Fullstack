<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Admin\AdminCreateCategoryRequest;
    use App\Http\Requests\Admin\AdminUpdateCategoryRequest;
    use App\Models\Category;
    use App\Models\Language;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Str;

    class CategoryController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $languages = Language::all();
            return view('admin.category.index' , compact('languages'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            $languages = Language::all();

            return view('admin.category.create' , compact('languages'));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store( AdminCreateCategoryRequest $request )
        {
            $category = Category::create([
                'language' => $request->input('language') ,
                'name' => $request->input('name') ,
                'slug' => Str::slug($request->input('name')) ,
                'show_at_navbar' => $request->input('show_at_navbar') ,
                'status' => $request->input('status') ,
            ]);
            toast(__('Category have been Created successfully') , 'success');
            return redirect()->route('admin.category.index');

//            Or this Way to insert
//            $category = new Category();
//            $category->language = $request->input('language');
//            $category->name = $request->input('name');
//            $category->name = Str::slug($request->input('slug'));
//            $category->show_at_navbar = $request->input('show_at_navbar');
//            $category->status = $request->input('status');
//            toast(__('Category have been Created successfully') , 'success');
//            $category->save();


//            dd($request->all());
        }

        /**
         * Display the specified resource.
         */
        public function show( string $id )
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit( string $id )
        {
            $languages = Language::all();
            $category = Category::findOrFail($id);
            return view('admin.category.edit' , compact('languages' , 'category'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update( AdminUpdateCategoryRequest $request , string $id )
        {
            $category = Category::findOrFail($id);
            $category->name = $request->input('name');
            $category->slug = Str::slug($request->input('name'));
            $category->language = $request->input('language');
            $category->show_at_navbar = $request->input('show_at_navbar');
            $category->status = $request->input('status');
            $category->save();
            toast(__('Category have been Updated successfully') , 'success');
            return redirect()->route('admin.category.index');
//            dd($request->all());
        }
        /**
         * Remove the specified resource from storage.
         */
        public function destroy( string $id )
        {
            try {
                $category = Category::findorFail($id);
                $category->delete();
                return response([ 'status' => 'success' , 'message' => 'Deleted successfully' ]);
            } catch (\Throwable $th) {
                return response([ 'status' => 'error' , 'message' => 'Something went wrong' ]);
            }
        }
    }
