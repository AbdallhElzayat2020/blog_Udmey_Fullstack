<?php

    namespace App\traits;

    use Illuminate\Http\File;
    use Illuminate\Http\Request;

    trait FileUploadTrait
    {
        public function handleFileUpload( Request $request , $dir = 'uploads' , $oldPath = null )
        {
            if ($oldPath && File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }
//            if ($request->hasFile('file')) {
//                $file = $request->file('file');
//                $fileName = $file->getClientOriginalName();
//                $file->move(public_path($dir), $fileName);
//                return $dir . '/' . $fileName;
//            }
        }
    }
