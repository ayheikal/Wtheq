<?php

namespace App\Responses;
use Illuminate\Http\Response;

class ApiResponse
{
    public static function success($data, $message = "Success")
    {
        return response()->json([
            'data' => $data,
            'success' => true,
            'message' => $message,
        ]);
    }

    public static function error($message='', $status = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'data' => null,
            'success' => false,
            'message' => $message,
        ], $status);
    }

    public function sendError( $error , $errorMessages = [], $code = 401)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}
