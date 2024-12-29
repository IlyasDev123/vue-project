<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

function sendSuccess($message, $data = [], $statusCode = 200)
{
    return response()->json(
        [
            'status' => true,
            'message' => $message,
            'data' => $data,
        ],
        $statusCode
    );
}

function sendError($message, $data = [], $statusCode = 400)
{
    return response()->json(
        [
            'status' => false,
            'message' => $message,
            'data' => $data
        ],
        $statusCode
    );
}

function storeFiles($folder, $file)
{

    return Storage::disk(env('STORAGE_TYPE'))->put($folder, $file);
    // return Storage::disk(env('STORAGE_TYPE'))->url($url);
}

function saveFile($file, $path, $prefix = '')
{
    try{

        if (!$file || !$path) {
            return false;
        }

        if ($file->getClientOriginalExtension() != 'exe') {

            $extension = $file->getClientOriginalExtension();
            $fileName =  $prefix . Str::random(15) . time() . '.' . $extension;

            Storage::disk('public')->putFileAs($path, $file, $fileName);

            return $fileName;
        }

        return false;

    }
    catch(\Exception $e){

        Log::info("Image Store failed, ". $e->getMessage());

        return false;
    }
}

function base64ToImage($request, $path = null)
{
    if ($request->cv) {
        $ext = explode('/', mime_content_type($request->cv))[1];
        $img = $request->base_string;
        $file_name = 'image_' . time() . '.pdf';
        @list($type, $img) = explode(';', $img);
        @list(, $img)      = explode(',', $img);

        if ($img != "") {

            $tmpPath = Storage::disk('local')->put($file_name, base64_decode($img));
            $contents = Storage::disk('local')->get($file_name);

            $s3FilePath = $path . '/' . $file_name;

            $imgname = Storage::disk('s3')->put($s3FilePath, $contents);

            if ($imgname) {

                Storage::disk('local')->delete($file_name);
                return $s3FilePath;
            }
        }
    }
    return false;
}