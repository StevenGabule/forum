<?php

namespace Forum\Http\Controllers;

use Forum\Thread;
use Forum\Trending;

class SearchController extends Controller
{
    public function show(Trending $trending)
    {
        $search = request('q');
        $thread =  Thread::search($search)->paginate(25);

        if (request()->expectsJson()) {
            return $thread;
        }

        return view('threads.index', [
            'threads' => $thread,
            'trending' => $trending->get()
        ]);
    }
}
