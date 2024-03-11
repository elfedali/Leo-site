<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'owner_id' => $this->owner_id,
            'position' => $this->position,
            'title' => $this->title,
            'status' => $this->status,
            'node_id' => $this->node_id,
        ];
    }
}
