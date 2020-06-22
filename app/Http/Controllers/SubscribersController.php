<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;

class SubscribersController extends Controller
{
    public function store(Request $request){
        $subscriber = Subscriber::create(['email'=>$request->subscriber]);
        return response()->json($subscriber);
    }

    public function find($email){
        $subscriber = Subscriber::whereEmail($email)->first();
        if($subscriber){
            return response()->json($subscriber);

            
        }else{
            return response()->json([], 404);
        }
    }


    public function delete(Request $request){

    }
}
