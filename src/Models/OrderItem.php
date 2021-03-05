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
use Epmnzava\BillMe\Models\Order;


class OrderItem extends Model
{
    protected $guarded = [];
    protected $table="order_items";

   /**
     * Get the order that owns the orderItem.
     */
    public function Order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

}
