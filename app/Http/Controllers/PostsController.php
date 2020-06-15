<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\PostResource;
use JD\Cloudder\Facades\Cloudder;

class PostsController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'title'=>'required',
            'body'=>'required',
            'image'=>'required'
        ]);
        $image = Cloudder::upload($request->file('image'))->getResult()['url'];
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

    public function allPosts($opt=""){
        $posts = Post::paginate(10);
        return PostResource::collection($posts);
    }

    public function update(Request $request){
        $post = Post::find($request->id);
        $post->body = $request->body;
        $post->title = $request->title;
        if($request->hasFile('image')){
            //Upload the image
            $image_url = Cloudder::upload($request->file('image'))->getResult()['url'];
            //Delete the old image
            $old_img = basename($post->image);
            $public_id = explode('.', $old_img)[0];
            Cloudder::destroyImage($public_id);
            Cloudder::delete($old_img);
            //store the new url
            $post->image = $image_url;
        }

        $post->save();
        return response()->json($request->all());
    }

    public function delete(Request $request){
        $post = Post::findOrFail($request->id);        
        $post->delete();
        return response()->json('Deleted', 200);
    }
}
