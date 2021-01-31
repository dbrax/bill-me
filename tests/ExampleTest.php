<?php

namespace Epmnzava\BillMe\Tests;

use Orchestra\Testbench\TestCase;
use Epmnzava\BillMe\BillMeServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [BillMeServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
