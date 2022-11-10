<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AlbumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'releaseyear' => $this->releaseyear,
            'artist_id' => $this->artist->id,
            'artist_name' => $this->artist->name,
            'artist_age' => $this->artist->age,
            'artist_pob' => $this->artist->pob
        ];
    }
}
