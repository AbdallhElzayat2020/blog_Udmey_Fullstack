<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Admin\AdminLanguageStoreRaequest;
    use App\Http\Requests\Admin\AdminLanguageUpdateRequest;
    use App\Models\Language;
    use Illuminate\Http\Request;
    use RealRashid\SweetAlert\Facades\Alert;

    class LanguageController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $languages = Language::all();

//            $languages = Language::select('id' , 'name' , 'lang' , 'default' , 'status')->get();

            return view('admin.language.index' , compact('languages'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('admin.language.create');
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store( AdminLanguageStoreRaequest $request )
        {
            Language::create([
                'lang' => $request->input('lang') ,
                'name' => $request->input('name') ,
                'slug' => $request->input('slug') ,
                'status' => $request->input('status') ,
                'default' => $request->input('default') ,
            ]);
            toast(__('Language have been Created successfully') , 'success');

            return redirect()->route('admin.language.index');

//            or

//            $language = new Language();
//            $language->name = $request->input('name');
//            $language->lang = $request->input('lang');
//            $language->status = $request->input('status');
//            $language->slug = $request->input('slug');
//            $language->default = $request->input('default');

//            toast(__('Language have been Created successfully') , 'success');
//            $language->save();
//            return redirect()->route('admin.language.index');

        }

        /**
         * Display the specified resource.
         */
        public function show( string $id )
        {
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit( string $id )
        {
            $language = Language::findorFail($id);
            return view('admin.language.edit' , compact('language'));
        }

        /**
         * Update the specified resource in storage.
         */

        public function update( AdminLanguageUpdateRequest $request , string $id )
        {
            $language = Language::findorFail($id);
            $language->name = $request->input('name');
            $language->lang = $request->input('lang');
            $language->status = $request->input('status');
            $language->slug = $request->input('slug');
            $language->default = $request->input('default');
            $language->save();
            toast(__('Language have been Updated successfully') , 'success');
            return redirect()->route('admin.language.index');
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy( string $id )
        {
            try {
                $language = Language::findorFail($id);
                if ($language->lang === 'en') {
                    return response([ 'status' => 'error' , 'message' => 'Can n\'t delete english language' ]);
                }
                $language->delete();
                return response([ 'status' => 'success' , 'message' => 'Deleted successfully' ]);
            } catch (\Throwable $th) {
                return response([ 'status' => 'error' , 'message' => 'Something went wrong' ]);
            }
        }
    }