<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LockThreads extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function non_administrator_may_not_lock_threads()
    {
        $this->signIn();
        $thread = create('Forum\Thread', ['user_id' => auth()->id()]);
        $this->post(route('locked-threads.store', $thread))->assertStatus(403);
        $this->assertFalse(!!$thread->fresh()->locked);
    }

    /** @test */
    function administrators_can_lock_threads()
    {
        $this->signIn(factory('Forum\User')->states('administrator')->create());
        $thread = create('Forum\Thread', ['user_id' => auth()->id()]);
        $this->post(route('locked-threads.store', $thread));
        $this->assertTrue(!!$thread->fresh()->locked, 'Failed asserting that the thread was locked.');
    }

    /** @test */
    public function once_locked_a_thread_may_not_receive_new_replies()
    {
        $this->signIn();
        $thread = create('Forum\Thread');
        $thread->lock();
        $this->post($thread->path() . '/replies', [
            'body' => 'Foobar',
            'user_id' => auth()->id()
        ])->assertStatus(422);
    }
}

