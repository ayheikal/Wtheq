<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use Validator;
use App\Responses\ApiResponse;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
         $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            "name" => ["required","string","max:255","min:2"],
            "username" => ["required","string","min:2","max:255","unique:users"],
            "password" => ["required","string","min:6"],
            "avatar" => ["required","string"],
            "user_type_id" => ["required","integer","exists:user_types,id"],
        ]);


        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return ApiResponse::error($errors);
        }
        try {

            $data = $validator->validated();// use only the validated data for storing
            $response = $this->userService->store($data);
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
        //
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
