<?php

namespace Forum\Http\Controllers;

use Forum\Notifications\ThreadWasUpdated;
use Forum\Thread;

class ThreadSubscriptionsController extends Controller
{
    public function store($channelId, Thread $thread)
    {
         $thread->subscribe();
    }

    public function destroy($channelId, Thread $thread)
    {
        $thread->unsubscribe();
    }



}
