<?php

/**
 * Author: Emmanuel Paul Mnzava
 * Twitter: @epmnzava
 * Github:https://github.com/dbrax/tigopesa-tanzania
 * Email: epmnzava@gmail.com
 * 
 */

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
