<?php

namespace Tests;

use Forum\Exceptions\Handler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use NunoMaduro\Collision\Adapters\Laravel\ExceptionHandler;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $this->disableExceptionHandling();
    }

    public function signIn($user = null)
    {
        $user = $user ?: create('Forum\User');
        $this->actingAs($user);
        return $this;
    }

    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);
        $this->app->instance(ExceptionHandler::class, new class extends Handler
        {
            public function __construct() {}
            public function report(\Exception $e)
            {
            }

            public function render($request, \Exception $e)
            {
                throw $e;
            }
        });
    }

    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);
        return $this;
    }
}
