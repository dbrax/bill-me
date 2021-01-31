<?php

namespace Epmnzava\BillMe;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Epmnzava\BillMe\Skeleton\SkeletonClass
 */
class BillMeFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bill-me';
    }
}
