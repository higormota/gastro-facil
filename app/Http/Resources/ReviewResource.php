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
            'comment'        => $this->comment,
            'images'         => $this->images,
            'avg_rating'     => $this->avg('ratings'),
            'count_rating'   => $this->feedback->count(),
            'feedback'       => $this->feedback('comment')
        ];

    }
}
