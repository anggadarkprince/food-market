<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'restaurant_name' => $this->restaurant_name,
            'location' => [
                'address' => $this->address,
                'lat' => $this->lat,
                'lng' => $this->lng,
            ],
            'description' => $this->description,
            'foods' => FoodResource::collection($this->whenLoaded('foods')),
        ];
    }
}
