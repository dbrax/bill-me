<?php

/**
 * Author: Emmanuel Paul Mnzava
 * Twitter: @epmnzava
 * Github: https://github.com/dbrax/bill-me
 * Email: epmnzava@gmail.com
 * 
 */

namespace Epmnzava\BillMe;


use Epmnzava\BillMe\Models\BillingPayment;
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
        return Order::where('date', date('Y-m-d'))->get();
    }


    public function get_orders_with_status($status)
    {
        return Order::where('status', $status)->get();
    }

    public function pending_orders()
    {
        return Order::where('status', "pending")->get();
    }

    public function cancelled_orders()
    {
        return Order::where('status', "cancelled")->get();
    }

    public function completed_orders()
    {
        return Order::where('status', "complete")->get();
    }

    public function getOrderById($orderid)
    {
        return Order::find($orderid);
    }

    public function getOrdersOnDate($date)
    {
        return Order::where('date', $date)->get();
    }


    public function getOrdersOnDateRange($startdate, $enddate)
    {
    }


    /** Function to get an invoice */
    public function getInvoiceById($invoiceid)
    {
        return Invoice::find($invoiceid);
    }


    /**
     * 
     * User Queries
     */


    /** Function to get given user orders */
    public function getUserOrders($userid)
    {
        return Order::where('userid', $userid)->get();
    }


    /** Function to get given user orders by status */
    public function getUserOrdersByStatus($userid, $status)
    {
        return Order::where('userid', $userid)->where('status', $status)->get();
    }


    /** Function to get given user invoices */
    public function getUserInvoices($userid)
    {
        return Invoice::where('userid', $userid)->get();
    }



    /** Function to get given user invoices by status */
    public function getUserInvoiceByStatus($userid, $status)
    {
        return Invoice::where('userid', $userid)->where('status', $status)->get();
    }




    /** Function to get given user invoices by status */
    public function sumUserInvoiceByStatus($userid, $status)
    {
        return Invoice::where('userid', $userid)->where('status', $status)->sum('amount');
    }




    /** Function to get given user invoices by status */
    public function totalUserInvoiceByStatus($userid, $status)
    {
        return Invoice::where('userid', $userid)->where('status', $status)->count();
    }


    public function getAllBillingHistory()
    {

        return BillingPayment::all();
    }


    public function getUserBillingHistory($userid)
    {

        return BillingPayment::where('userid', $userid)->get();
    }



    public function getUserBillingHistoryByStatus($userid, $status)
    {

        return BillingPayment::where('userid', $userid)->where('status', $status)->get();
    }
}
