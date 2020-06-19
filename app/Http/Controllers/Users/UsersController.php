<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;

class UsersController extends Controller
{
    public function getUserByUsername(Request $request, $username=""){
        if(!$request->get('id')){
            $user = User::whereUsername($username)->first();
        }else{
            $validator = Validator::make($request->all(), [
                'username'=>[Rule::unique('users')->ignore($request->get('id'))]
            ]);

            if($validator->fails()){
                $user = User::whereUsername($request->post('username'))->first();
                return response()->json($user, 200);
            }else{

                return response()->json([], 200);

            }
        }

        return response()->json($user);
    }

    public function getUserByEmail(Request $request, $email=""){
        if(!$request->get('id')){
            $user = User::whereEmail($email)->first();
        }else{
            $validator = Validator::make($request->all(), [
                'email'=>[Rule::unique('users')->ignore($request->get('id'))]
            ]);

            if($validator->fails()){
                $user = User::whereEmail($request->post('email'))->first();
                return response()->json($user, 200);
            }else{

                return response()->json([], 200);

            }
        }
        return response()->json($user);
    }

    public function addUser(Request $request){
        $newUser = User::create([
            'username'=>$request->username,
            'role_id'=>$request->role,
            'password'=>bcrypt($request->password),
            'name'=>$request->name,
            'email'=>$request->email,
        ]);
        return response()->json($newUser);
    }

    public function allUsers(Request $request){
        $users = User::where('id', '<>', auth()->id())->orderBy('name')->paginate($request->get('per_page'));
        return response()->json($users);
    }

    public function getUserById($id){
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $request){
        $user = User::find($request->id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->name = $request->name;
        if(isset($request->password)){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return response()->json($user);
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return response()->json('Ok');
    }

    public function getAuthUser(){
        return response()->json(auth()->user());
    }


}
