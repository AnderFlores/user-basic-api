<?php

namespace App\Infrastructure\Controllers;

use App\Application\GetUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUsersListController extends BaseController
{
    private $getUserService;
    public function __construct(GetUserService $getUserListService)
    {
        $this->getUserService = $getUserListService;
    }
    public function __invoke(): JsonResponse
    {
        try {
            $getUserService = $this->getUserService->getList();
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'list' => $getUserService
        ], Response::HTTP_OK);
    }
}
