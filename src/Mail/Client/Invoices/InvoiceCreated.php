<?php

/**
 * Author: Emmanuel Paul Mnzava
 * Twitter: @epmnzava
 * Github: https://github.com/dbrax/bill-me
 * Email: epmnzava@gmail.com
 * 
 */

namespace Epmnzava\BillMe\Mail\Client\Invoices;

use Epmnzava\BillMe\Models\Order;
use Epmnzava\BillMe\Models\Invoice;
use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceCreated extends Mailable
{
    use Queueable, SerializesModels;

    public Invoice $invoice;
    public   $pdf;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function build()
    {
        //$this->pdf = PDF::loadView('billme::emails.attachments.createdInvoice',[]);

        return $this->markdown('billme::emails.invoices.invoice_created');
        
        /*->attachData($this->pdf, 'invoice.pdf', [
            'mime' => 'application/pdf',
        ] 
        );;*/
    }
}
