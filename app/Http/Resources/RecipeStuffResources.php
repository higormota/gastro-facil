<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeStuffResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'recipe_id'   => $this->recipe_id,
            'name'        => $this->name,
            'quantity'    => $this->quantity,
            'metric'      => $this->metric
        ];
    }
}
