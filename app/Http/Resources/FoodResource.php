<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    protected $includeRestaurant = true;

    public function includeRestaurant($value){
        $this->includeRestaurant = $value;
        return $this;
    }

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
            'food_name' => $this->food_name,
            'description' => $this->description,
            'ingredients' => $this->ingredients,
            'price' => $this->price,
            'rating' => $this->rating,
            'category' => $this->category,
            'image_url' => $this->image_url,
            $this->mergeWhen($this->includeRestaurant, [
                'restaurant' => new RestaurantResource($this->restaurant),
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
