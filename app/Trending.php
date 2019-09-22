<?php

namespace Forum;

use Illuminate\Support\Facades\Redis;

class Trending
{
    public function get()
    {
        return array_map('json_decode', Redis::zrevrange($this->cacheKey(), 0, 4));
    }

    protected function cacheKey()
    {
        return app()->environment('testing') ? 'testing_trending_threads' : 'trending_threads';
    }

    public function push($thread)
    {
         Redis::ZINCRBY($this->cacheKey(), 1, json_encode(['title' => $thread->title,'path' => $thread->path()]));
    }

    public function reset()
    {
        Redis::del($this->cachekey());
    }
}
