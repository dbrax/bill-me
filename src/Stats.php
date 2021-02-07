<?php

/**
 * Author: Emmanuel Paul Mnzava
 * Twitter: @epmnzava
 * Github: https://github.com/dbrax/bill-me
 * Email: epmnzava@gmail.com
 * 
 */

namespace Epmnzava\BillMe;

use Epmnzava\BillMe\Models\Order;
use Epmnzava\BillMe\Models\Invoice;
use Epmnzava\BillMe\Models\OrderItem;
use Epmnzava\BillMe\Mail\Client\Invoices\InvoiceCreated;
use Epmnzava\BillMe\Mail\Client\OrderReceived;
use Epmnzava\BillMe\Mail\Merchant\NewOrder;

use Mail;

class Stats
{

    public function total_orders()
    {

        return Order::count();
    }

    public function total_cancelled_orders()
    {
        return Order::where('status', 'cancelled')->count();
    }

    public function total_pending_orders()
    {
        return Order::where('status', 'pending')->count();
    }

    public function total_completed_orders()
    {
        return Order::where('status', 'completed')->count();
    }


    public function total_orders_today()
    {
    }

    public function total_orders_this_month()
    {
        return Order::whereMonth('date', '=', date('m'))->whereYear('date', '=', date('Y'))->count();
    }

    public function total_orders_this_year()
    {
        return Order::whereYear('date', '=', date('Y'))->count();
    }


    public function total_invoices()
    {
    }
}
