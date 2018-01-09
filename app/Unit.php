<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //


    /**
     * Get the weekly producer prices for this unit.
     */
    public function producerPricesSellUnit ()
    {
        return $this->hasMany('App\ProducerPrice', 'sell_unit_id');
    }
}
