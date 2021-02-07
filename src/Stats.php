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

    public function total_orders(){
    
        return Order::count();
    }

    public function total_cancelled_orders(){

    }

    public function total_pending_orders(){

    }

    public function total_completed_orders(){

    }


    public function total_orders_today(){
        
    }

    public function total_orders_this_month(){
        
    }

    public function total_orders_this_year(){
        
    }


    
}
