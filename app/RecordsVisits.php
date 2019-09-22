<?php


namespace Forum;


use Illuminate\Support\Facades\Redis;

trait RecordsVisits
{

    public function resetVisits()
    {
        Redis::del($this->visitCacheKey());
        return $this;
    }

    public function recordVisits()
    {
        Redis::incr("threads.{$this->id}.visits");
        return $this;
    }

    public function visits()
    {
        return Redis::get($this->visitCacheKey()) ??0;
    }

    protected function visitCacheKey()
    {
        return "threads.{$this->id}.visits";
    }
}
