<?php

namespace Forum\Inspections;

class Spam
{
    protected $inspections = [
        InvalidKeywords::class,
        KeyHelpDown::class
    ];

    public function detect($body)
    {
        foreach ($this->inspections as $inspection) {
            app($inspection)->detect($body);
        }
        return false;
    }
}
