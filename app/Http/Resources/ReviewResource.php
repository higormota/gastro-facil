<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'recipe_id' => $this->recipe_id,
            'user_id'   => $this->user_id,
            'comment'   => $this->comment
        ];

    }
}
