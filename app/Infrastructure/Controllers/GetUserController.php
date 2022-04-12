<?php

namespace App\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUserController extends BaseController
{
    public function __invoke(string $userId): JsonResponse
    {
        if (true) {
            return response()->json([
                'id' => "1",
                'email' => "user@user.com"
            ], Response::HTTP_ACCEPTED);
        } else {
            return response()->json([
                'error' => "User does not exist"
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
