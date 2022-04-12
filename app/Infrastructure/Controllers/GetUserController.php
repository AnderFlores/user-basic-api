<?php

namespace App\Infrastructure\Controllers;

use App\Application\GetUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUserController extends BaseController
{

    private $getUserService;
    public function __construct(GetUserService $getUserService)
    {
        $this->getUserService = $getUserService;
    }
    public function __invoke(int $id): JsonResponse
    {
        try {
            $getUserService = $this->getUserService->getUser($id);
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([
            'id' => $getUserService->getId(),
            'email' => $getUserService->getEmail()
        ], Response::HTTP_OK);
    }
}
