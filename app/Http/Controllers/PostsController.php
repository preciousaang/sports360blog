<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\PostResource;

class PostsController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'title'=>'required',
            'body'=>'required',
            'image'=>'required'
        ]);
        $image = basename($request->file('image')->store('public/uploads'));
        $newPost = Post::create([
            'category_id'=>1,
            'title'=>$request->title,
            'body'=>$request->body,
            'featured'=>true,
            'user_id'=>auth()->id(),
            'image'=>$image
        ]);
        return response()->json($newPost, 200);
    }

    public function list(){
        $posts = Post::latest()->get();
        return PostResource::collection($posts);
    }

    public function single($id){
        $post = Post::find($id);
        return response()->json(new PostResource($post));
    }
}
