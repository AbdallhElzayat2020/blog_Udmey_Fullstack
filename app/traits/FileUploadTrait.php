<?php

namespace App\traits;

// use Illuminate\Http\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait FileUploadTrait
{

    public function handleFileUpload(Request $request, string $fileName, ?string $oldPath = null, string $dir = 'uploads'): ?string
    {

        //check if request have img
        if (!$request->hasFile($fileName)) {
            return null;
        }

        //check if file exists
        if ($oldPath && File::exists(public_path($oldPath))) {
            File::delete(public_path($oldPath));
        }

        $file = $request->file($fileName);

        $extension = $file->getClientOriginalExtension();

        $updatedFileName = Str::random(20) . '.' . $extension;

        $file->move(public_path($dir), $updatedFileName);

        $filePath = $dir . '/' . $updatedFileName;

        return $filePath;
    }

    //Handle File Delete
    public function deleteFile(string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
