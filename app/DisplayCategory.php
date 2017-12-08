<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisplayCategory extends Model
{
    //
    /**
     * Get the producer prices for this display category.
     */
    public function producerPrices()
    {
        return $this->hasMany('App\ProducerPrice');
    }

}
