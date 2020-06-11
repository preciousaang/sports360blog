<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title'=> $this->title,
            'image' => secure_asset('storage/uploads/'.$this->image),
            'created_at' => $this->created_at,
            'updated_at'=>$this->updated_at,
            'user' => User::find($this->user_id),
            'category'=> Category::find($this->category_id),
            'body' => $this->body
        ];
    }
}
