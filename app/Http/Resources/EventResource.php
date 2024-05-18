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
            'start_date' =>now()->parse($this->start_date)->toFormattedDateString(),
            'end_date' =>now()->parse($this->end_date)->toFormattedDateString(),
            'start_time' =>now()->parse($this->start_time)->toTimeString('minute'),
            'end_time' => now()->parse($this->end_time)->toTimeString('minute'),
            'location' =>$this->location,
            'link' => route('event.show',$this->id)

        ];
    }
}


