<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineItem extends Model
{
    //

    /**
     * Get the order for this line item.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }



    /**
     * Get the producer price for this line item.
     */
    public function producerPrice()
    {
        return $this->belongsTo('App\ProducerPrice');
    }
}
