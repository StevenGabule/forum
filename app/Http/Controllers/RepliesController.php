<?php

namespace Forum\Http\Controllers;

use Forum\Http\Requests\CreatePostForm;
use Forum\Reply;
use Forum\Thread;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index($channelId, Thread $thread)
    {
        return $thread->replies()->paginate(10);
    }

    public function store($channelId, Thread $thread, CreatePostForm $form)
    {
        if ($thread->locked) {
            return response('Thread is locked', 422);
        }
        return $thread->addReply(['body' => request('body'), 'user_id' => auth()->id()])->load('owner');
    }

    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);
        $this->validate(request(), ['body' => 'required|spamfree']);
        $reply->update(request(['body']));
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);
        $reply->delete();
        if (request()->expectsJson()) return response(['status' => 'Reply deleted']);
        return back();
    }

}
