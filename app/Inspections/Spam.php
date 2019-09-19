<?php

namespace Forum\Inspections;

use Exception;
class Spam
{
    protected $inspections = [ InvalidKeywords::class, KeyHelpDown::class ];

    /**
     * @param $body
     * @return bool
     * @throws Exception
     */
    public function detect($body)
    {
        foreach ($this->inspections as $inspection) {
            app($inspection)->detect($body);
        }
        return false;
    }
}
