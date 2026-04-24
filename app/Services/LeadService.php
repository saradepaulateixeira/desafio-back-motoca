<?php

namespace App\Services;

use App\Http\Requests\StoreLeadRequest;
use App\Models\Lead;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

class LeadService
{
    public function getAll(): Collection
    {
        return Lead::query()
            ->with('vehicle')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getByVehicleId(int $vehicleId): Collection
    {
        $vehicle = Vehicle::findOrFail($vehicleId);

        return $vehicle->leads()->orderBy('id', 'desc')->get();
    }

    public function create(StoreLeadRequest $request): Lead
    {
        $data = $request->validated();

        $vehicle = Vehicle::findOrFail($data['vehicle_id']);

        return Lead::create($data);
    }

    public function getCountByVehicle(int $vehicleId): int
    {
        return Vehicle::findOrFail($vehicleId)->leads()->count();
    }
}
