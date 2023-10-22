<?php

use App\Models\User;    

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
