<?php

/**
 * Author: Emmanuel Paul Mnzava
 * Twitter: @epmnzava
 * Github:https://github.com/dbrax/bill-me
 * Email: epmnzava@gmail.com
 * 
 */

namespace Epmnzava\BillMe\Models;

use Illuminate\Database\Eloquent\Model;

class BillingPayment extends Model
{
    protected $guarded = [];
    protected $table="billing_payments";
}
