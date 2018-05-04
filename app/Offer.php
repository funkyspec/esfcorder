<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //

    /**
     * Get the customer orders for this offer.
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * Get the producer prices for this offer.
     */
    public function producerPrices()
    {
        return $this->hasMany('App\ProducerPrice');
    }


}
