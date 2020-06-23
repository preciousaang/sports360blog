<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Http\Resources\PostResource;
use JD\Cloudder\Facades\Cloudder;
use App\Events\PostCreated;
use App\Notifications\PostWasPublished;
use Illuminate\Support\Facades\Notification;

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
        event(new PostCreated($newPost));
        //Notification::send(\App\User::all(), new PostWasPublished($newPost));    
        $newPost->notify(new PostWasPublished());    
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
        $post = Post::where(['slug'=>$slug, 'published'=>true])->where('created_at', '<', date('Y-m-d H:i:s', time()))->first();
        if($post){
            $post->views++;
            $post->save();
            return response()->json(new PostResource($post));
        }else{
            return response()->json(['message'=>'Post Not Found'], 404);
        }

    }

    public function getPostsByCategorySlug(Request $request, $slug){
        $category = Category::whereSlug($slug)->first();
        if($category){
            $posts = $category->posts()->wherePublished(true)->latest()->paginate(15);
            if($request->has('limit')){
                $posts = $category->posts()->wherePublished(true)->latest()->limit(5)->get();
            }
            return PostResource::collection($posts);
        }
    }

    public function allPosts($opt=""){
        $posts = Post::latest()->paginate(30);
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
        $image_url = Cloudder::upload($request->file('image'))->getResult()['url'];
        return  $image_url;
    }

    public function popularPosts($category=""){
        if($category){
            $category = Category::where('slug', $category)->first();
            if($category){
                $posts = $category->posts()->wherePublished(true)->orderBy('views', 'desc')->limit(10)->get();
            }
        }else{
            $posts = Post::wherePublished(true)->orderBy('views', 'desc')->limit(10)->get();
        }

        return response()->json($posts);
    }

    public function search(Request $request){
        $posts = Post::where('title', 'like', "%{$request->post('search')}%")->paginate(1           );
       
        return PostResource::collection($posts);
    }
}
