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

class BillMe
{



    /** A function that triggers order creation */
    public function createOrder(
        string $firstname,
        string $lastname,
        string $email,
        string $mobile_number,
        int $amount,
        string $payment_method,
        string $notes,
        string $address,
        array $orderitems
    ) {

        $order = new Order;
        $order->firstname = $firstname;
        $order->lastname = $lastname;
        $order->email = $email;
        $order->mobile_number = $mobile_number;
        $order->amount = $amount;
        $order->payment_method = $payment_method;
        $order->status = "Pending";
        $order->notes = $notes;
        $order->address = $address;
        $order->date = date("Y-m-d");

        $order->save();

        // order items ... here

        if (!empty($orderitems)) {
            /* $orderItem=new OrderItem();
          $orderItem->order_id=$order->id;
          $orderItem->amount=$orderitems->amount;
          $orderItem->quantity=$orderitems->quantity;


          */
        }

        Mail::to(["address" => $order->email, "name" => $order->email])->send(new OrderReceived($order));

        Mail::to(["address" => $order->email, "name" => $order->email])->send(new NewOrder($order));
    }




    public function createInvoice(Order $order)
    {

        $invoice = new Invoice;
        $invoice->orderid = $order->id;
        $invoice->firstname = $order->firstname;
        $invoice->lastname = $order->lastname;
        $invoice->mobile_number = $order->mobile_number;
        $invoice->email = $order->email;
        $invoice->amount = $order->amount;
        $invoice->status = $order->status;
        $invoice->address = $order->address;
        $invoice->date = date('Y-m-d');
        $invoice->save();


        Mail::to(["address" => $invoice->email, "name" => $invoice->email])->send(new InvoiceCreated($invoice));



        $order_update = Order::find($order->id);
        $order_update->invoiceid = $invoice->id;
        $order_update->save();
    }
}
