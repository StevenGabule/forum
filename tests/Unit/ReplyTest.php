<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;
    /** @test*/
    function it_has_an_owner()
    {
        $reply = create('Forum\Reply');
        $this->assertInstanceOf('Forum\User', $reply->owner);
    }
}
