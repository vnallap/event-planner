<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->_id,
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'banner_path' => $this->banner_path,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'registrations_count' => $this->registrations()->count(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}