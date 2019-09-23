<?php

namespace Forum\Http\Controllers\Api;

use Forum\User;
use Forum\Http\Controllers\Controller;

class RegisterConfirmationController extends Controller
{
    public function index()
    {
        $user = User::where('confirmation_token', request('token'))->first();
        if (!$user) {
            return redirect(route('threads'))->with('flash', 'Unknown token.');
        }
        $user->confirm();
        return redirect('/threads')->with('flash', 'Your account is now confirmed! You may post to the forum!');
    }
}
