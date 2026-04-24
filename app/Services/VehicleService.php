<?php

namespace App\Services;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Vehicle;
use Illuminate\Pagination\LengthAwarePaginator;

class VehicleService
{
public function getAll(array $filters = []): LengthAwarePaginator
    {
        $query = Vehicle::query()->withCount('leads');

        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (isset($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        return $query->orderBy('id', 'desc')->paginate(15);
    }

    public function getById(int $id): ?Vehicle
    {
        return Vehicle::query()->find($id);
    }

    public function create(StoreVehicleRequest $request): Vehicle
    {
        $data = $request->validated();
        $data['brand'] = $data['brand'] ?? 'Honda';

        return Vehicle::create($data);
    }

    public function update(Vehicle $vehicle, UpdateVehicleRequest $request): Vehicle
    {
        $vehicle->update($request->validated());

        return $vehicle->fresh();
    }

    public function delete(Vehicle $vehicle): bool
    {
        return $vehicle->delete();
    }

    public function getLeadCount(int $vehicleId): int
    {
        return Vehicle::findOrFail($vehicleId)->leads()->count();
    }
}