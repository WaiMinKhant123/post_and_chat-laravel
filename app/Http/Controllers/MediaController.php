<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the uploaded files
        $request->validate([
            'media_files.*' => 'mimes:jpg,jpeg,png,gif,mp4,avi|max:2048000', // Max size 20MB
        ]);

        // Check if files are uploaded
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $file) {
                // Get file type and store file
                $fileType = $file->getClientMimeType();
                $filePath = $file->store('media'); // Store file in 'media' directory

                // Store file information in the database
                Media::create([
                    'file_path' => $filePath,
                    'file_type' => strpos($fileType, 'video') !== false ? 'video' : 'photo',
                    'user_id' => auth()->id(), // Associate the media with the authenticated user
                ]);
            }
        }

        return back()->with('success', 'Files uploaded successfully');
    }
}
