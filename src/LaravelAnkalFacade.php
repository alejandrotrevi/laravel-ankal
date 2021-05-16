<?php

namespace Alejandrotrevi\LaravelAnkal;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Alejandrotrevi\LaravelAnkal\Skeleton\SkeletonClass
 */
class LaravelAnkalFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-ankal';
    }
}
