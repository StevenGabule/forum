<?php

namespace Forum\Http\Controllers\Api;

use Forum\User;
use Forum\Http\Controllers\Controller;

class RegisterConfirmationController extends Controller
{
    public function index()
    {
        User::where('confirmation_token', request('token'))->firstOrFail()->confirm();
        return redirect('/threads')->with('flash', 'Your account is now confirmed! You may post to the forum!');
    }
}
