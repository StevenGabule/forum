<?php

namespace Forum\Http\Controllers;

use Exception;
use Forum\Http\Requests\CreatePostForm;
use Forum\Reply;
use Forum\Thread;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

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
//        if (\Gate::denies('create', new Reply)) return response('You are posting too frequently. Please take a break.', 429);
        return $thread->addReply(['body' => request('body'), 'user_id' => auth()->id()])->load('owner');
//        return $form->persist($thread);
    }

    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);
        try {
            $this->validate(request(), ['body' => 'required|spamfree']);
            $reply->update(request(['body']));
        } catch (Exception $e) {
            return response('Sorry, your reply could not be saved at this time.', 422);
        }
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);
        $reply->delete();
        if (request()->expectsJson()) return response(['status' => 'Reply deleted']);
        return back();
    }

}
