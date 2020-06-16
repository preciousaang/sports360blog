<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    public function list(){
        $categories = Category::paginate(25);
        return response()->json($categories);
    }

    public function allCategrories(){
        $categories = Category::all();
        return response()->json($categories);
    }

    public function getCategory(Request $request){
        if($request->get('title')){
            $category = Category::where('title', $request->get('title'))->first();
        }else {
            $category = Category::find($request->id);
        }

        return response()->json($category);
    }

    public function editCategory(Request $request){
        $request->validate([
            'title'=>['required', Rule::unique('categories')->ignore($request->id)]
        ]);
        $category = Category::find($request->id);
        $category->title = $request->title;
        $category->save();
        return response()->json($category);
    }

    public function delete($id){
        $cat = Category::find($id);
        $cat->delete();
        return response()->json("Ok");
    }



    public function store(Request $request){
        $category = Category::create(['title'=>$request->title]);
        return response()->json($category);
    }
}
