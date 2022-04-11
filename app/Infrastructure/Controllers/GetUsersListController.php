<?php

namespace App\Infrastructure\Controllers;

use App\Application\GetUserList\GetUserListService;
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
            $getUserListService = $this->getUserListService->execute();
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'list' => $getUserListService
        ], Response::HTTP_OK);
    }
}
