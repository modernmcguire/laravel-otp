<?php

namespace ModernMcGuire\Drawbridge\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ModernMcGuire\Drawbridge\Drawbridge
 */
class Drawbridge extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ModernMcGuire\Drawbridge\Drawbridge::class;
    }
}
