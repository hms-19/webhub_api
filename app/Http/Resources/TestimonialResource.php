<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
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
            'image' => isset($this->image) ? asset('images').'/'.$this->image : null,
            'field' => $this->field,
            'comment' => $this->comment,
            'rate' => $this->rate
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
