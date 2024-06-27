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
        // تحقق إذا كان هناك ملف في الطلب
        if (!$request->hasFile($fileName)) {
            return null;
        }

        // تحقق إذا كان الملف موجودًا
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

    // دالة لحذف الملف
    public function deleteFile(string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }

    public function duplicateFile(string $path, string $dir = 'uploads'): ?string
    {
        if (!File::exists(public_path($path))) {
            return null;
        }

        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $newFileName = Str::random(20) . '.' . $extension;
        $newFilePath = $dir . '/' . $newFileName;

        File::copy(public_path($path), public_path($newFilePath));

        return $newFilePath;
    }
}
