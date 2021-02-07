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

class Queries extends Stats
{

    public function orders()
    {

        return Order::all();
    }


    public function orders_orderby($orderby)
    {

    }



    public function orders_today()
    {
        return Order::where('date',date('Y-m-d'))->get();
    }

    public function pending_orders()
    {
        return Order::where('status',"pending")->get();

    }

    public function cancelled_orders()
    {
        return Order::where('status',"cancelled")->get();

    }

    public function completed_orders()
    {
        return Order::where('status',"complete")->get();

    }

    public function getOrderById($orderid)
    {
        return Order::find($orderid);
    }

    public function getOrdersOnDate($date)
    {
        return Order::where('date',$date)->get();

    }
    

    public function getOrdersOnDateRange($startdate, $enddate)
    {
    }


    public function getInvoiceById($invoiceid)
    {
        return Invoice::find($invoiceid);

    }
}
