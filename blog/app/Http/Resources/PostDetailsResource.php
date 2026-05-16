<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title'=> $this->title,
            'content'=> $this->content,
            'image' => $this->image ? asset('storage/'. $this->image ) : null,
            'auhtor_name' => $this->author->name,
        ];
    }
}
