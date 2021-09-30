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
use Epmnzava\BillMe\Models\Receipt;
use Epmnzava\BillMe\Models\Invoice;
use Epmnzava\BillMe\Models\OrderItem;
use Epmnzava\BillMe\Mail\Client\Invoices\InvoiceCreated;
use Epmnzava\BillMe\Mail\Client\OrderReceived;
use Epmnzava\BillMe\Mail\Merchant\NewOrder;
use Carbon\Carbon;
use Epmnzava\BillMe\Mail\Client\Invoices\InvoicePaid;
use Epmnzava\BillMe\Models\BillingPayment;
use Epmnzava\BillMe\Models\PaymentMethod;
use Mail;

class BillMe extends Queries
{

    public function __construct()
    {
    }

    /**
     * A function that triggers order creation
     *
     */


    public function createOrder(
        string $firstname,
        string $lastname,
        string $email,
        string $mobile_number,
        float $amount,
        string $payment_method,
        string $notes,
        string $ordertitle = "",
        string $address,
        array $orderitems,
        $userid = null,
        $orderid = null
    ): Order {

        $order = new Order;

        if (!empty($orderid))
           $order->orderid = $orderid;


        $order->userid = $userid;
        $order->firstname = $firstname;
        $order->lastname = $lastname;
        $order->email = $email;
        $order->mobile_number = $mobile_number;
        $order->amount = $amount;
        $order->payment_method = $payment_method;
        $order->status = "pending";
        $order->notes = $notes;
        $order->ordertitle = $ordertitle;
        $order->address = $address;
        $order->date = date("Y-m-d");

        $order->save();

        // Loop through order items here
        if (!empty($orderitems)) {

            for ($i = 0; $i < count($orderitems); $i++) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->amount = $orderitems[$i]['amount'];
                $orderItem->quantity = $orderitems[$i]['quantity'];
                $orderItem->item = $orderitems[$i]['item'];
                $orderItem->extra_details = serialize($orderitems[$i]['extra_details']);
                $orderItem->date = date("Y-m-d");

                $orderItem->save();
            }
        }


        $invoice = $this->createInvoice($order);

        if (config('bill-me.send_mail') == 1)
            $this->sendMailNotifications($order, $invoice);

        $billing_record = $this->add_billing_record($order, $invoice);

        return $order;
    }



    public function add_billing_record(Order $order, Invoice $invoice): BillingPayment
    {

        $bill_payment = new BillingPayment;
        $bill_payment->userid = $order->userid;
        $bill_payment->invoiceid = $invoice->id;
        $bill_payment->orderid = $order->id;
        $bill_payment->amount = $invoice->amount;


        $bill_payment->date = $order->date;
        $bill_payment->save();


        return $bill_payment;
    }


    /**
     * Function that triggers sending of email notification for orders
     */

    public function sendMailNotifications(Order $order, Invoice $invoice): void
    {
        Mail::to(["email" => $order->email])->send(new OrderReceived($order));
        Mail::to(["email" => config('bill-me.your_mail_address')])->send(new NewOrder($order));
        Mail::to(["address" => $invoice->email])->send(new InvoiceCreated($invoice));
    }



    /**
     * Function that creates an invoie from an order
     */

    public function createInvoice(Order $order): Invoice
    {

        $invoice = new Invoice;
        $invoice->orderid = $order->id;
        $invoice->userid = $order->userid;
        $invoice->firstname = $order->firstname;
        $invoice->lastname = $order->lastname;
        $invoice->mobile_number = $order->mobile_number;
        $invoice->email = $order->email;
        $invoice->invoice_title = $order->ordertitle;
        $invoice->amount = $order->amount;
        $invoice->status = $order->status;
        $invoice->address = $order->address;
        $invoice->date = date('Y-m-d');
        $invoice->due_date = Carbon::now()->addDays(config('bill-me.due_date_duration'))->format('Y-m-d');
        $invoice->save();

        $order_update = Order::find($order->id);
        $order_update->invoiceid = $invoice->id;
        $order_update->save();

        return $invoice;
    }


    public function order_paid($orderid): void
    {

        $invoiceid = Invoice::where('orderid', $orderid)->first()->id;

        $this->invoice_paid($invoiceid);
    }


    /**
     * Function gets @param invoiceid and updates order , invoice and billing record that the user has paid
     */
    public function invoice_paid($invoiceid): Invoice
    {

        $invoice = Invoice::find($invoiceid);
        $invoice->status = "paid";
        $invoice->save();

        $order = Order::find($invoice->orderid);
        $order->status = "completed";
        $order->save();

        $billing = $this->paid_billing_record($invoiceid);

        //$receiptid = $this->create_receipt($invoiceid, $billingid);

        // create email notification invoice paid order paid..

        if (config('bill-me.send_mail') == 1)
            Mail::to(["email" => $order->email])->send(new InvoicePaid($invoice));


        return  $invoice;
    }

    /**
     * Function gets @param invoiceid and @param billingid and creates receipt
     */
    public function create_receipt($invoiceid, $billingid): int
    {

        $receipt = new Receipt;
        $receipt->invoiceid = $invoiceid;
        $receipt->paymentid = $billingid;
        $receipt->save();

        return $receipt->id;
    }



    public function paid_billing_record($invoiceid): BillingPayment
    {

        $billing_record = BillingPayment::find(BillingPayment::where('invoiceid', $invoiceid)->first()->id);
        $billing_record->status = "paid";
        $billing_record->save();

        return  $billing_record;
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

    /**
     * Function to update invoice
     */

    public function update_invoice(string $invoiceid, Invoice $invoice): Invoice
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


    /**
     * Function that updates an  order  returns void
     */
    public function update_order(string $order_id, Order $order): void
    {
    }


    /**
     * Function that updates and  status to cancelled  returns void
     */
    public function cancel_order(string $orderid): void
    {
        $order = Order::find($orderid);
        $order->status = "cancelled";
        $order->save();
    }


    /**
     * Function that deletes an order returns void
     */
    public function delete_order(string $orderid)
    {

        $order = Order::find($orderid);
        $order->delete();
        $this->delete_invoice($orderid);
    }

    /**
     * Function that deletes an invoice returns void
     */
    public function delete_invoice(string $orderid): void
    {

        $invoice = Invoice::where('orderid', $orderid)->delete();
    }
}
