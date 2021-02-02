<?php

/**
 * Author: Emmanuel Paul Mnzava
 * Twitter: @epmnzava
 * Github: https://github.com/dbrax/bill-me
 * Email: epmnzava@gmail.com
 * 
 */

namespace Epmnzava\BillMe\Tests;

use Orchestra\Testbench\TestCase;
use Epmnzava\BillMe\BillMeServiceProvider;

class OrderTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [BillMeServiceProvider::class];
    }

    /** @created order  */

    public function an_order_can_be_created()
    {
    }


    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
