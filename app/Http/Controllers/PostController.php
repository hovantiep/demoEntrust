<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Entrust;

class PostController extends Controller
{
    public function show(){

        $roles = ['admin', 'owner'];
        if (Entrust::user()->hasRole($roles, true)){
            return view('show_post');
        }
        abort(403, 'Messages');
    }

}
