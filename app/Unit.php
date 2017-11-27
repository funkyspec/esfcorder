<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //


    /**
     * Get the weekly producer prices for this unit.
     */
    public function producerPrices()
    {
        return $this->hasMany('App\ProducerPrice');
    }
}
