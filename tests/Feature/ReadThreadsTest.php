<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;
    public $thread;
    public function setUp(): void
    {
        parent::setUp();
        $this->thread = create('Forum\Thread');
    }

    /** @test */
    public function a_user_can_browse_threads()
    {
        $response = $this->get($this->thread->path())->assertSee($this->thread->title);
    }

    /** @test */
    function a_user_can_read_a_single_thread()
    {
        $this->get($this->thread->path())->assertSee($this->thread->title);
    }

    /** @test */
//    function a_user_can_read_replies_that_are_associated_with_a_thread()
//    {
//        $reply = create('Forum\Reply', ['thread_id' => $this->thread->id]);
//        $this->get('/threads/' . $this->thread->id)->assertSee($reply->body);
//    }

}
