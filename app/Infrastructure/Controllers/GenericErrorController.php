<?php

namespace App\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GenericErrorController extends BaseController
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'error' => "There was an error making the request"
        ], Response::HTTP_BAD_REQUEST);
    }
}
