<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class MediaController extends Controller
{
    public function delete($fileId)
    {
        $media = Media::find($fileId);
        if (!$media) {
            return response()->json(["message", "File not found"], 404);
        }

        try {
            $destination = 'uploads/article/' . $media->file_path;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $media->delete();
            return response()->json(["message", "File delete"], 200);
        } catch (Exception $ex) {
            return response()->json(["message", "Internal server error"], 500);
        }
    }
}
