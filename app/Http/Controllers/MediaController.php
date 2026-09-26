<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the uploaded files
        $request->validate([
            'media_files.*' => 'mimes:jpg,jpeg,png,gif,mp4,avi|max:102400', // Max size 20MB
        ]);

        // Check if files are uploaded
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $file) {
                $fileType = $file->getClientMimeType();
                $isVideo = strpos($fileType, 'video') !== false;

                // Cloudinary ဆီသို့ ဖိုင်တင်ခြင်း
                $uploadedFileUrl = Cloudinary::upload($file->getRealPath(), [
                    'folder' => 'media',
                    'resource_type' => $isVideo ? 'video' : 'image'
                ])->getSecureUrl();

                // Store file information in the database
                Media::create([
                    'file_path' => $uploadedFileUrl, // Cloudinary URL အပြည့်အစုံကို DB ထဲ သိမ်းမည်
                    'file_type' => $isVideo ? 'video' : 'photo',
                    'user_id' => auth()->id(), 
                ]);
            }
        }

        return back()->with('success', 'Files uploaded to Cloudinary successfully!');
    }
}