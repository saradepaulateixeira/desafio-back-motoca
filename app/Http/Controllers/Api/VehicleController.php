<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Services\VehicleService;
use Illuminate\Http\JsonResponse;

class VehicleController extends Controller
{
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function index()
    {
        $filters = request()->only(['type', 'max_price']);
        $vehicles = $this->vehicleService->getAll($filters);

        return VehicleResource::collection($vehicles);
    }

    public function store(StoreVehicleRequest $request): JsonResponse
    {
        $vehicle = $this->vehicleService->create($request);

        return (new VehicleResource($vehicle))
            ->response()
            ->setStatusCode(201);
    }

    public function show(int $id): JsonResponse|VehicleResource
    {
        $vehicle = $this->vehicleService->getById($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Veículo não encontrado'], 404);
        }

        return new VehicleResource($vehicle);
    }

    public function update(UpdateVehicleRequest $request, int $id): JsonResponse|VehicleResource
    {
        $vehicle = $this->vehicleService->getById($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Veículo não encontrado'], 404);
        }

        $vehicle = $this->vehicleService->update($vehicle, $request);

        return new VehicleResource($vehicle);
    }

    public function destroy(int $id): JsonResponse
    {
        $vehicle = $this->vehicleService->getById($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Veículo não encontrado'], 404);
        }

        $this->vehicleService->delete($vehicle);

        return response()->json(['message' => 'Veículo excluído com sucesso']);
    }
}