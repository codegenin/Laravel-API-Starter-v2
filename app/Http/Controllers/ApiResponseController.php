<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiResponseController extends Controller
{
    /**
     * General error response
     *
     * @param $message
     * @return mixed
     */
    public function responseWithError($message)
    {
        return response()->json([
            'status'  => false,
            'message' => $message
        ]);
    }
    
    /**
     * General success response
     *
     * @param $message
     * @return mixed
     */
    public function responseWithSuccess($message)
    {
        return response()->json([
            'status'  => true,
            'message' => $message
        ]);
    }
    
    /**
     * General resource response
     *
     * @param $resource
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseWithResource($resource)
    {
        return response()->json(array_merge([
            'status' => true
        ], $resource));
    }
    
    /**
     * General resource collection response
     *
     * @param $collection
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseWithCollection($collection)
    {
        return response()->json(array_merge([
            'status' => true
        ], collect($collection)->toArray()));
    }
}
