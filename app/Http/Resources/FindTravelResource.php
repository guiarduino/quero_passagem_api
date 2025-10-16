<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\QueroPassagemService;

class FindTravelResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $service = self::$queroPassagemService ?? app(QueroPassagemService::class);

        return [
            'id' => $this['id'] ?? null,
            'arrival' => $this['arrival'] ?? null,
            'departure' => $this['departure'] ?? null,
            'seatClass' => $this['seatClass'] ?? null,
            'from' => $this['from'] ?? null,
            'to' => $this['to'] ?? null,
            'price' => $this['price'] ?? null,
            'company' => $service->get('companies/'.$this->resource['company']['id']) ?? null,
            'travelDuration' => $this['travelDuration'] ?? null,
            'busData' => $service->post('new/seats', ['travelId' => $this['id'], 'orientation' => 'horizontal', 'type' => 'matrix']) ?? null,
        ];
    }
}
