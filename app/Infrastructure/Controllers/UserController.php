<?php

namespace App\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'error' => "User id is required"
        ], Response::HTTP_BAD_REQUEST);
    }
}
