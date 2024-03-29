<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use App\Category;

class PostResource extends JsonResource
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
            'id' => $this->id,
            'title'=> $this->title,
            'image' => $this->image,
            'created_at' => $this->created_at,
            'slug'=>$this->slug,
            'updated_at'=>$this->updated_at,
            'featured'=>$this->featured,
            'published'=>$this->published,
            'user' => User::find($this->user_id),
            'category'=> Category::find($this->category_id),
            'body' => $this->body
        ];
    }
}
