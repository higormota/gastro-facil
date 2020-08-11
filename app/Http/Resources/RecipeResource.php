<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
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
            'id'                => $this->id,
            'name'              => $this->name,
            'yield'             => $this->yield,
            'calories'          => $this->calories,
            'preparation_mode'  => $this->preparation_mode,
            'user_id'           => $this->user,
            'created_at'        => (string) $this->created_at,
            'updated_at'        => (string) $this->updated_at,
            'ratings'           => $this->ratings,
            'images'            => $this->images,
            'stuffs'            => $this->stuffs,
            'average_rating'    => $this->ratings->avg('rating')
            
          ];
    }
}
