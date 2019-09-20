<?php

namespace Forum\Http\Controllers\Api;

use Forum\User;
use Forum\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $search = request('name');
        return User::where('name', 'LIKE', "$search%")->take(5)->pluck('name');
    }
}
