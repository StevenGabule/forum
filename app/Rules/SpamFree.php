<?php


namespace Forum\Rules;


use Forum\Inspections\Spam;

class SpamFree
{
    public function passes($attribute, $value)
    {
        try {
            return ! resolve(Spam::class)->detect($value);
        } catch(\Exception $e) {
            return false;
        }
    }

    public function message()
    {
        return 'The :attribute contain spams.';
    }
}
