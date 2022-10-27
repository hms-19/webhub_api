<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'description' => $this->description,
            'author' => $this->author,
            'duration' => $this->duration,
            'image' => isset($this->image) ? asset('images').'/'.$this->image : null,
            'category' => new CategoryResource($this->category) ?? null,
            'date' => Carbon::parse($this->created_at)->format('M d, Y'),
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
