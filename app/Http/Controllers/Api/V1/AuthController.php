<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Responses\ApiResponse;
use App\Services\User\UserService;

class AuthController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
         $this->userService = $userService;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "username" => ["required","string","max:255"],
            "password" => ["required","string","min:1"],
        ]);


        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return ApiResponse::error($errors);
        }
        $username = $request->username;
        $password = $request->password;
        $response = $this->userService->authenticate($username, $password);
//        dd($response);
        if ($response == null) {
            $message = 'Authentication failed. Please try again later.';
            return ApiResponse::error($message);
        }
        $message = 'Authentication success';
        return ApiResponse::success($response, $message);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
