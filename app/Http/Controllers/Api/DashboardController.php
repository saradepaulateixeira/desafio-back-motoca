<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\DashboardResource;
use App\Services\DashboardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index(): JsonResource
    {
        $data = $this->dashboardService->getData();

        return new DashboardResource($data);
    }

    public function clearCache(): JsonResponse
    {
        $this->dashboardService->clearCache();

        return response()->json(['message' => 'Cache limpo com sucesso']);
    }
}