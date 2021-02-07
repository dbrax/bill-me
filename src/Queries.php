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


    public function orders_today()
    {
    }

    public function pending_orders(){

    }

    public function cancelled_orders(){

    }

    public function completed_orders(){
        
    }

    public function getOrderById($orderid){
        
    }

    public function getOrdersOnDate($date){
        
    }

    public function getOrdersOnDateRange($startdate,$enddate){
        
    }


    public function getInvoiceById($invoiceid){
        
    }
}
