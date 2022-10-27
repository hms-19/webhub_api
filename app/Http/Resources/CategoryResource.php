<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug ?? null,
            // 'logo' => isset($this->logo) ? asset('images').'/'.$this->logo : null,
            'children' => isset($this->children) ? CategoryResource::collection($this->children) : [],
            'blog_count' => count($this->blogs)
        ];
    }

    public function with($request)
    {
        return [
            'meta' => [
                'author' => 'Htet Myat Soe',
            ],
        ];
    }
}
