<?php


namespace Epmnzava\BillMe\Tests\Unit;

use Epmnzava\BillMe\Models\Order;
use Epmnzava\Mail\Merchant\NewOrder;
use Illuminate\Support\Facades\Mail;
use Orchestra\Testbench\TestCase;
use Epmnzava\BillMe\BillMeServiceProvider;


class NewOrderMailTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [BillMeServiceProvider::class];
    }


    /** @test */
    public function it_sends_a_neworder_email()
    {
        Mail::fake();

        $order =Order::create(['firstname' => 'Emmanuel','amount'=>1000]);

        Mail::assertNothingSent();

        Mail::to('epmnzava@gmail.com')->send(new NewOrder($order));

        Mail::assertSent(NewOrder::class, function ($mail) use ($order) {
            return $mail->order->id === $order->id
                && $mail->order->firstname === 'Emmanuel' && $mail->order->amount=1000;
        });
    }
}