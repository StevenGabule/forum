<?php

namespace Forum\Listeners;

use Forum\Events\ThreadReceivedNewReply;
use Forum\Notifications\YouWereMentioned;
use Forum\User;

class NotifyMentionedUsers
{
    /**
     * Handle the event.
     *
     * @param ThreadReceivedNewReply $event
     * @return void
     */
    public function handle(ThreadReceivedNewReply $event)
    {
        User::whereIn('name', $event->reply->mentionedUsers())->get()->each(function($user) use ($event) {
           $user->notify(new YouWereMentioned($event->reply));
        });
//        collect($event->reply->mentionedUsers())->map(function ($name) {
//            return User::where('name', $name)->first();
//        })->filter()->each(function ($user) use ($event) {
////            $user->notify(new YouWereMentioned($event->reply));
////        });
    }
}
