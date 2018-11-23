<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class LoginController extends Controller
{
    public function generateUser(){
        $uuid = Uuid::generate();
        $user = new User();
        $user->name =$uuid;
        $user->email =$uuid;
        $user->api_token =$uuid;
        $user->password =bcrypt($uuid);
        $user->save();
        return $uuid;
    }
}
