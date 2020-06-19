<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RolesController extends Controller
{
    public function getRoles(){
        $roles = Role::orderBy('title', 'asc')->get();

        return response()->json($roles);
    }
}
