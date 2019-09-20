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
//        preg_match_all('/\@([^\s\.]+)/', $event->reply->body, $matches);
//        $mentionedUsers = $event->reply->mentionedUsers();
        collect($event->reply->mentionedUsers())->map(function($name) {
                return User::where('name', $name)->first();
            })->filter()->each(function($user) use ($event) {
                $user->notify(new YouWereMentioned($event->reply));
            });
//        foreach ($mentionedUsers as $name) {
//            if ($user = User::where('name', $name)->first()) {
//                $user->notify(new YouWereMentioned($event->reply));
//            }
//        }
    }
}
