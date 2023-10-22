<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Responses\ApiResponse;



class UploadController extends Controller
{
   function upload(Request $request) : ?string {

    $validator = Validator::make($request->all(),[
        'file' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048'
    ]);

    if ($validator->fails()) {
        $errors = implode(', ', $validator->errors()->all());
        return ApiResponse::error($errors);
    }
    try {
        $file = $request->file;// use only the validated data for storing
        $storage = 'storage';
        $response = resizeImageAsWebP($file, $storage, $width=null, $height=null);
        $message = 'file uploaded successfully';
        return ApiResponse::success($response, $message);
    }catch(\Exception $e){
        $message = $e->getMessage();
        return ApiResponse::error($message);
    }

   }
}
