<?php

namespace App\Http\Resources;

use App\RelationTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintResource extends JsonResource
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
            'started_at' => $this->started_at,
            'finished_at' => $this->finished_at,
            'status' => [
                'name' => $this->status->name,
                'slug' => $this->status->slug,
                'color' => $this->status->color,
            ],
            'process_info' => new ProcessInfoResource($this->processInfo),
            'actions' => auth()->user()->organization_id ? $this->organizations->map(function ($item) {
                return $item->pivot
                    ->where('organization_id', auth()->user()->organization_id)
                    ->where('complaint_id', $this->id)
                    ->first()->relation_type;
            })->first() : 'observer'
        ];
    }
}
