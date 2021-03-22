<?php

/**
 * Author: Emmanuel Paul Mnzava
 * Twitter: @epmnzava
 * Github: https://github.com/dbrax/bill-me
 * Email: epmnzava@gmail.com
 *
 */

namespace Epmnzava\BillMe;

use Carbon\Carbon;
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
        return Order::where('status', "completed")->get();
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


    /** Function to get an invoice */
    public function getInvoiceByOrderId($orderid)
    {
        return Invoice::find(Order::where('id', $orderid)->first()->invoiceid);
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




    /** Function to get  orders by status */
    public function getOrdersByStatus( $status)
    {
        return Order::where('userid', $userid)->where('status', $status)->get();
    }



    /** Function to get given user invoices */
    public function getUserInvoices($userid)
    {
        return Invoice::where('userid', $userid)->get();
    }


    /** Function that returns total number of user invoices */
    public function totalUserInvoices($userid): int
    {
        return Invoice::where('userid', $userid)->count();
    }




    /** Function to get given user invoices by status */
    public function getUserInvoiceByStatus($userid, $status)
    {
        return Invoice::where('userid', $userid)->where('status', $status)->get();
    }




    /** Function to get given all  invoices by status */
    public function getInvoiceByStatus( $status)
    {
        return Invoice::where('status', $status)->get();
    }


    /**
     * @param $userid
     * @param $status
     * @return mixed
     * Function to get given user invoices by status
     */
    public function sumUserInvoiceByStatus($userid, $status) : int
    {
        return Invoice::where('userid', $userid)->where('status', $status)->sum('amount');
    }





    /**
     * @param $userid
     * @param $status
     * @return mixed
     *  Function to get given user invoices by status
     */
    public function totalUserInvoiceByStatus($userid, $status)
    {
        return Invoice::where('userid', $userid)->where('status', $status)->count();
    }

    /** Function that gets full  billing history */

    public function getAllBillingHistory()
    {

        return BillingPayment::all();
    }


    /** Function that gets full user billing history*/

    public function getUserBillingHistory($userid)
    {

        return BillingPayment::where('userid', $userid)->get();
    }




    public function getUserBillingHistoryByStartDate($userid, $start_date)
    {

        return BillingPayment::where('userid', $userid)->where('date', $start_date)->get();
    }


    /** Function to get payment history of a given user for a given period */

    public function getUserBillingHistoryBetweenDates($userid, $start_date, $enddate)
    {

        return BillingPayment::where('userid', $userid)->whereBetween('date', [$start_date, $enddate])->get();
    }


    /**
     * Returns the model instance to be updated
     */
    public function updateBillingHistory($invoiceid): BillingPayment
    {
        return BillingPayment::find(BillingPayment::where('invoiceid', $invoiceid)->first()->id);
    }


    /**
     * Returns the model instance to be updated
     */
    public function updateInvoiceByInstance($invoiceid): Invoice
    {
        return Invoice::find($invoiceid);
    }

    /**
     *
     * Returns updated invoice with new due_date
     */
    public function updateDueDate($date, $invoiceid): Invoice
    {
        $invoice = $this->updateInvoiceByInstance($invoiceid);
        $invoice->due_date = $date;
        $invoice->save();
        return $invoice;
    }



 public function getBillingHistoryByStatus($status)
    {

        return BillingPayment::where('status', $status)->get();
    }


    public function getUserBillingHistoryByStatus($userid, $status)
    {

        return BillingPayment::where('userid', $userid)->where('status', $status)->get();
    }

    /** Return OrderItems for particular order
     *@param $orderid
     **/
    public function getOrderItems($orderid)
    {

        return OrderItem::where('order_id', $orderid)->get();
    }


    /** Return OrderItems for particular order gets invoiceid
     *@param $invoiceid
     **/
    public function getOrderItemsByInvoiceId($invoiceid)
    {

        return OrderItem::where('order_id', Invoice::where('id', $invoiceid)->first()->orderid)->get();
    }
}
