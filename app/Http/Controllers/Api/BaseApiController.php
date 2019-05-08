<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseApiController extends Controller {
    public function error($message, $data, $code = 500) {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $code);
    }
    public function success($data, $code = 200) {
        return response()->json($data, $code);
    }
}