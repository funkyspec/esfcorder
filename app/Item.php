<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //


    /**
     * Get the weekly producer prices for this item.
     */
    public function producerPrices()
    {
        return $this->hasMany('App\ProducerPrice');
    }
}
