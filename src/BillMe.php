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

class BillMe extends Queries
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
        $order->status = "pending";
        $order->notes = $notes;
        $order->address = $address;
        $order->date = date("Y-m-d");

        $order->save();

        // order items ... here
        if (!empty($orderitems)) {

            for ($i = 0; $i < count($orderitems); $i++) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->amount = $orderitems[$i]->amount;
                $orderItem->quantity = $orderitems[$i]->quantity;
                $orderItem->item = $orderitems[$i]->item;
                $orderItem->extra_details = serialize($orderitems[$i]->extra_details);
                $orderItem->save();
            }
        }

        //perform checks if the user needs email service use a separate function here add bulk sms functionality ...


        $this->createInvoice($order);

        if (config('bill-me.send_mail') == 1)
            $this->sendMailNotifications($order);
    }


    public function sendMailNotifications(Order $order)
    {
        Mail::to(["email" => $order->email, "name" => $order->email])->send(new OrderReceived($order));
        Mail::to(["email" => $order->email, "name" => $order->email])->send(new NewOrder($order));
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

        if (config('bill-me.send_mail'))
            Mail::to(["address" => $invoice->email, "name" => $invoice->email])->send(new InvoiceCreated($invoice));




        $order_update = Order::find($order->id);
        $order_update->invoiceid = $invoice->id;
        $order_update->save();
    }


    /**
     * Function that gets you invoice details by using orderid
     */

    public function getInvoiceByOrderId($orderid)
    {
        return Invoice::where('orderid', $orderid)->first();
    }

    /**
     * Function that gets you invoice details by using invoiceid
     */

    public function getInvoiceByInvoiceId($invoiceid)
    {

        return Invoice::find($invoiceid);
    }



    /**
     * Function that gets you order details by using orderid
     */

    public function getOrderByOrderId($orderid)
    {
        return Order::find($orderid);
    }

    /**
     * Function that gets you order details by using invoiceid
     */

    public function getOrderByInvoiceId($invoiceid)
    {
        return Order::find(Invoice::where('id', $invoiceid)->first()->orderid);
    }


    /**
     * Function that updates invoice status and returns void
     */
    public function update_invoice_status(string $invoiceid, string $status): void
    {
        $invoice = Invoice::find($invoiceid);
        $invoice->status = $status;
        $invoice->save();
    }


    public function update_invoice(string $invoiceid, Invoice $invoice): void
    {
    }




    /**
     * Function that updates order status and returns void
     */
    public function update_order_status(string $orderid, string $status): void
    {
        $order = Order::find($orderid);
        $order->status = $status;
        $order->save();
    }



    public function update_order(string $order_id, Order $order): void
    {
    }

    public function cancel_order(string $orderid): void
    {
        $order = Order::find($orderid);
        $order->status = "cancelled";
        $order->save();
    }

    public function delete_order(string $orderid)
    {

        $order = Order::find($orderid);
        $order->delete();
        $this->delete_invoice($orderid);
    }

    public function delete_invoice(string $orderid): void
    {

        $invoice = Invoice::where('orderid', $orderid)->delete();
    }
}
