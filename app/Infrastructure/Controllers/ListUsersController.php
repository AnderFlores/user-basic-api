<?php

namespace App\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class ListUsersController extends BaseController
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            ['id' => "1"],
            ['id' => "2"],
            ['id' => "3"]
        ], Response::HTTP_BAD_REQUEST);
    }
}
