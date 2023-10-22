<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Product\ProductService;
use App\Responses\ApiResponse;
use Validator;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
         $this->productService = $productService;
    }

    public function index()
    {
        try {
            $response =  $this->productService->getProducts();

            return ApiResponse::success($response);
        } catch (\Exception $e) {
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "name" => ["required","string","max:255","min:2","unique:products"],
            "description" => ["required","string","min:2","max:800"],
            "image" => ["required","string"],
            "slug" => ["required","string"],
            "price" => ["required","integer","min:1"],
        ]);


        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return ApiResponse::error($errors);
        }
        try {
            $data = $validator->validated();// use only the validated data for storing

            $response = $this->productService->store($data);
            $message = 'user registered successfully';
            return ApiResponse::success($response, $message);
        }catch(\Exception $e){
            $message = $e->getMessage();
            return ApiResponse::error($message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            // use only the validated data for storing
            $response = $this->productService->getProductById($id);
            $message = 'product retreived successfully';

            return $response?ApiResponse::success($response, $message):ApiResponse::error("product not found");

        }catch(\Exception $e){
            $message = $e->getMessage();
            return ApiResponse::error($message);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
