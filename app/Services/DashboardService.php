<?php

namespace App\Services;

use App\Http\Resources\DashboardResource;
use App\Models\Lead;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Cache;

class DashboardService
{
    public function getData(): DashboardResource
    {
        $data = Cache::remember('dashboard_data', 60, function () {
            return $this->buildData();
        });

        return new DashboardResource($data);
    }

    private function buildData(): array
    {
        $totalVehicles = Vehicle::query()->count();
        $totalLeads = Lead::query()->count();
        $avgPrice = Vehicle::query()->avg('price') ?? 0;

        $mostRequested = Vehicle::query()
            ->withCount('leads')
            ->orderByDesc('leads_count')
            ->first();

        $carLeads = Lead::query()
            ->whereHas('vehicle', fn($q) => $q->where('type', 'car'))
            ->count();
        $motorcycleLeads = Lead::query()
            ->whereHas('vehicle', fn($q) => $q->where('type', 'motorcycle'))
            ->count();

        $insights = [];
        if ($carLeads > $motorcycleLeads) {
            $insights[] = 'Carros recebem mais leads que motos';
        } elseif ($motorcycleLeads > $carLeads) {
            $insights[] = 'Motos recebem mais leads que carros';
        } else {
            $insights[] = 'Carros e motos têm interesse equilibrado';
        }

        return [
            'total_vehicles' => $totalVehicles,
            'total_leads' => $totalLeads,
            'avg_price' => round($avgPrice, 2),
            'most_requested_vehicle' => $mostRequested ? [
                'id' => $mostRequested->id,
                'model' => "{$mostRequested->brand} {$mostRequested->model}",
                'leads_count' => $mostRequested->leads_count,
            ] : null,
            'leads_by_type' => [
                'car' => $carLeads,
                'motorcycle' => $motorcycleLeads,
            ],
            'insights' => $insights,
        ];
    }

    public function clearCache(): void
    {
        Cache::forget('dashboard_data');
    }
}