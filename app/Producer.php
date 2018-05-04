<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    //


    /**
     * Get the weekly producer prices for this producer.
     */
    public function producerPrices()
    {
        return $this->hasMany('App\ProducerPrice');
    }

    /**
     * Get the US state for this producer.
     */
    public function state()
    {
        return $this->belongsTo('App\State');
    }

    /**
     * Get all line items for an offer for this producer.
     */
    public function lineItems()
    {
        return $this->hasManyThrough('App\LineItem', 'App\ProducerPrice');
    }
}
