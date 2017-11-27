<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the fulfillment status for the order.
     */
    public function fulfillment()
    {
        return $this->belongsTo('App\Fulfillment');
    }

    /**
     * Get the line items for this order.
     */
    public function lineItems()
    {
        return $this->hasMany('App\LineItem');
    }

}
