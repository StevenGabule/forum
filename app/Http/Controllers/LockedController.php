<?php

namespace Forum\Http\Controllers;

use Forum\Thread;
use Illuminate\Http\Request;

class LockedController extends Controller
{
    public function store(Thread $thread)
    {
        $thread->lock();
    }

    public function destroy(Thread $thread)
    {
        $thread->unlock();
    }
}
