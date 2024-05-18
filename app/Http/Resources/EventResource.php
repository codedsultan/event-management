<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'name' => $this->title,
            'details' => $this->description,
            'bg_image_path' =>$this->bg_image_path ?? 'https://staging.theyardtsc.com/retina.webp' ,
            'start_date' =>$this->start_date,
            'end_date' =>$this->end_date,
            'start_time' =>$this->start_time,
            'end_time' =>$this->end_time,
            'location' =>$this->location,


        ];
    }
}


