<?php

namespace Forum\Http\Controllers;

use Forum\Reply;

class BestRepliesController extends Controller
{
    public function store(Reply $reply)
    {
//        $this->authorize('update', $reply->thread);
        $reply->thread->markBestReply($reply);
    }
}
