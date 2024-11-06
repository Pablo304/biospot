<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlagueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->plagueType->name,
            'description' => $this->processInfo->description,
            'is_public' => $this->plagueType->is_public,
            'actions' => auth()->user()->organization_id ? $this->organizations->map(function ($item) {
                return $item->pivot
                    ->where('organization_id', auth()->user()->organization_id)
                    ->where('plague_id', $this->id)
                    ->first()->relation_type;
            })->first() : 'observer'
        ];
    }
}
