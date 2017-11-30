<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProducerPrice extends Model
{
    //

    /**
     * Get the item for this producer price.
     */
    public function item()
    {
        return $this->belongsTo('App\Item');
    }


    /**
     * Get the unit for this producer price.
     */
    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }

    /**
     * Get the producer for this producer price.
     */
    public function producer()
    {
        return $this->belongsTo('App\Producer');
    }

    /**
     * Get the offer for this producer price.
     */
    public function offer()
    {
        return $this->belongsTo('App\Offer');
    }

    /**
     * Get the line items for this producer price.
     */
    public function lineItems()
    {
        return $this->hasMany('App\LineItem');
    }



}
