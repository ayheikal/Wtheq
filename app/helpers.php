<?php

use App\Models\User;
use Image as Image;



function ResponseCollection($collection) :?array {

    return [

        "collection"=>$collection->collection,
        'links' => [
            'first' => $collection->url(1),
            'last' => $collection->url($collection->lastPage()),
            'prev' => $collection->previousPageUrl(),
            'next' => $collection->nextPageUrl(),
        ],
        'meta' => [
            'current_page' => $collection->currentPage(),
            'from' => $collection->firstItem(),
            'last_page' => $collection->lastPage(),
            'path' => $collection->path(),
            'per_page' => $collection->perPage(),
            'to' => $collection->lastItem(),
            'total' => $collection->total(),
        ],
    ];
}
function paginatedRowsCount() : int {

    return 15;

}

function authenticatedUser() : ?User {

    return auth("api")->user();

}
function resizeImageAsWebP($file, $storage, $width=null, $height=null)
{
    // $storage= $storage."seller/";
    if($file == ''|| $file == null)return $file;
    $image = $file;
    $input['file'] = rand(123456, 999999).time().'.'.'webp';
    $destinationPath = public_path($storage);
    $imgFile = Image::make($image->getRealPath())->encode('webp', 90);
    if($height==null){
        $height = $imgFile->height();
    }
    if($width==null){
        $width = $imgFile->width();
    }

    $imgFile->resize($width, $height, function ($constraint) {
    })
    ->save($destinationPath.'/'.$input['file']);


    return $storage.'/'.$input['file'];
}
