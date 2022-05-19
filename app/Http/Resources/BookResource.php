<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'writer' => $this->writer,
            'time of listened' => $this->listening_times,
            'image link' => $this->Book_image_link,
            'audio link' => $this->Book_audio_link,
            'isFavorite' => $this->isFavoritedByUser(),

        ];
    }
}
