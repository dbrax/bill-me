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
use Carbon\Carbon;

use Mail;

class Stats
{

    /**
     * Gets total count of orders 
     */
    public function total_orders()
    {

        return Order::count();
    }

    /**
     * Gets total count of cancelled orders 
     */
    public function total_cancelled_orders()
    {
        return Order::where('status', 'cancelled')->count();
    }

    /**
     * Gets total count of pending orders 
     */
    public function total_pending_orders()
    {
        return Order::where('status', 'pending')->count();
    }

/**
     * Gets total sum of pending orders 
     */
    public function sum_of_pending_amount(){

     return Invoice::where('status', 'pending')->sum('amount');   
    }

    public function total_completed_orders()
    {
        return Order::where('status', 'completed')->count();
    }

    /**
     * Gets total count of orders today
     */

    public function total_orders_today()
    {
        return Order::where('date', date('Y-m-d'))->count();
    }


    /**
     * Gets total count of orders on a particular day
     */
    public function total_orders_on_date($date)
    {
        return Order::where('date', $date)->count();
    }

    /**
     * Gets total count of orders on this month
     */

    public function total_orders_this_month()
    {
        return Order::whereMonth('date', '=', date('m'))->whereYear('date', '=', date('Y'))->count();
    }


    /**
     * Gets total count of orders on a particular month and year
     */
    public function total_orders_on_month($month, $year)
    {
        return Order::whereMonth('date', '=', $month)->whereYear('date', '=', $year)->count();
    }


    /**
     * Gets total count of orders on given year
     */
    public function total_orders_on_year($year)
    {
        return Order::whereYear('date', '=', $year)->count();
    }


    /**
     * Gets total count of invoices
     */
    public function total_invoices()
    {
        return Invoice::count();
    }


    /**
     * Gets total count of invoices today
     */

    public function total_invoices_today()
    {
        return Invoice::where('date', date('Y-m-d'))->count();
    }


      /**
     * Gets total count of pending orders 
     */
    public function total_pending_invoices()
    {
        return Invoice::where('status', 'pending')->count();
    }

/**
     * Gets total sum of pending orders 
     */
    public function sum_of_pending_invoice_amount(){

     return Invoice::where('status', 'pending')->sum('amount');   
    }




      /**
     * Gets total count of pending invoices by status 
     */
    public function total_invoice_count_by_status($status)
    {
        return Invoice::where('status', $status)->count();
    }





/**
     * Gets total sum of pending invoices by status 
     */
    public function sum_of_given_invoice_status_amount($status){

     return Invoice::where('status', $status)->sum('amount');   
    }



      /**
     * Gets total count of completed invoices 
     */
    public function total_completed_invoices()
    {
        return Invoice::where('status', 'completed')->count();
    }

/**
     * Gets total sum of completed invoices 
     */
    public function sum_of_completed_invoice_amount(){

     return Invoice::where('status', 'completed')->sum('amount');   
    }



}
