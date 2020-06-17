<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Http\Resources\PostResource;
use JD\Cloudder\Facades\Cloudder;

class PostsController extends Controller
{
    public function store(Request $request){
        $image = Cloudder::upload($request->file('image'))->getResult()['url'];
        $newPost = Post::create([
            'category_id'=>json_decode($request->category),
            'title'=>$request->title,
            'body'=>$request->body,
            'published'=>json_decode($request->published),
            'featured'=>json_decode($request->featured),
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

    public function getPostBySlug($slug){
        $post = Post::where(['slug'=>$slug, 'published'=>true])->first();
        return response()->json(new PostResource($post));
    }

    public function getPostsByCategorySlug($slug){
        $category = Category::where(['slug'=>$slug])->first();
        $posts = $category->posts()->wherePublished(true)->paginate(25);
        return PostResource::collection($posts);
    }

    public function allPosts($opt=""){
        $posts = Post::latest()->paginate(1);
        return PostResource::collection($posts);
    }

    public function update(Request $request){
        //return response()->json($request);
        $post = Post::find($request->id);
        $post->body = $request->body;
        $post->title = $request->title;
        if(is_numeric(json_decode($request->category))){
            $post->category_id = json_decode($request->category);
        }else{
            $post->category_id = (int)json_decode($request->category)->id;
        }

        $post->featured = json_decode($request->featured);
        $post->published = json_decode($request->published);
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

    public function uploadImage(Request $request){
        $file = basename($request->file('file')->store('public/uploads'));
        return  asset('storage/uploads/'.$file);
    }
}
