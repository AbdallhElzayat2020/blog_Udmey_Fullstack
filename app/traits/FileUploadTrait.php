<?php

    namespace App\traits;

    use Illuminate\Http\File;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;

    trait FileUploadTrait
    {
//        public function handleFileUpload( Request $request , $fileName , $directory = 'uploads' , $oldPath = null )
//        {
//            //  delete if img exists
//            if ($oldPath && File::exists(public_path($oldPath))) {
//
//                File::delete(public_path($oldPath));
//            }
////            check if Have file
//            if ( !$request->hasFile($fileName)) {
//
//                return null;
//            }
//
//            $file = $request->file($fileName);
//
//            $extension = $file->getClientOriginalExtension();
//
//            $updatedFileName = Str::random(20) . '.' . $extension;
//
//            $file->move(public_path($directory) , $updatedFileName);
//            $filePath = $directory . '/' . $updatedFileName;
//
//            return $filePath;
//
//        }


        public function handleFileUpload( Request $request , $fileName , $dir = 'uploads' , $oldPath = null )
        {
//            check if file exists
            if ($oldPath && File::extists(public_path($oldPath))) {

                File::delte(public_path($oldPath));
            }
//            check if request has img
            if ( !$request->hasFile($fileName)) {
                return null;
            }

            $file = $request->file($fileName);

            $extension = $file->getClientOriginalExtension();

            $updatedFileName = Str::random(20) . '.' . $extension;

            $file->move(public_path($dir) , $updatedFileName);

            $filePath = $dir . '/' . $updatedFileName;

            return $filePath;
        }
    }
