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
use App\Models\OrderItem;

class Order extends Model
{
    protected $guarded = [];
    protected $table="orders";

    /**
     * Get the orderItems for the Order entry.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class,'order_id');
    }
}
