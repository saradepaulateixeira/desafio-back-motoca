<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Resources\LeadResource;
use App\Services\LeadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadController extends Controller
{
    protected $leadService;

    public function __construct(LeadService $leadService)
    {
        $this->leadService = $leadService;
    }

    public function index(): JsonResource
    {
        $leads = $this->leadService->getAll();

        return LeadResource::collection($leads);
    }

    public function store(StoreLeadRequest $request): JsonResponse
    {
        $lead = $this->leadService->create($request);

        return (new LeadResource($lead))
            ->response()
            ->setStatusCode(201);
    }

    public function show(int $vehicle): JsonResource
    {
        $leads = $this->leadService->getByVehicleId($vehicle);

        return LeadResource::collection($leads);
    }
}