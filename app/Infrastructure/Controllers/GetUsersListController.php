<?php

namespace App\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUsersListController extends BaseController
{
    private $getUserListService;
    public function __construct(GetUserListService $getUserListService)
    {
        $this->getUserListService = $getUserListService;
    }
    public function __invoke(): JsonResponse
    {
        try {
            $isEarlyAdopter = $this->getUserListService->execute();
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
        return response()->json([
            'list' => $this->getUserListService
        ], Response::HTTP_OK);
    }
}
