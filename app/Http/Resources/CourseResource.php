<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'price' => $this->price,
            'outline' => $this->outline,
            'description' => $this->description,
            'category' => $this->category->name,
            'duration' => $this->duration,
            'student' => $this->student,
            'comment_count' => $this->comment_count,
            'image' => isset($this->image) ? asset('images').'/'.$this->image : null,
            'created_at' => Carbon::parse($this->created_at)->format('mm d, YYYY')
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
