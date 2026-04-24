<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'summary' => [
                'total_vehicles' => $this->resource['total_vehicles'],
                'total_leads' => $this->resource['total_leads'],
                'avg_price' => $this->resource['avg_price'],
            ],
            'most_requested_vehicle' => $this->resource['most_requested_vehicle'],
            'leads_by_type' => $this->resource['leads_by_type'],
            'insights' => $this->resource['insights'],
        ];
    }
}